<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\EventListener;

use Mautic\CoreBundle\Event\BuilderEvent;
use Mautic\CoreBundle\Event\TokenReplacementEvent;
use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Helper\BuilderTokenHelper;
use Mautic\CoreBundle\Helper\BuilderTokenHelperFactory;
use Mautic\EmailBundle\EmailEvents;
use Mautic\EmailBundle\Event\EmailSendEvent;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\LeadBundle\Entity\Tag;
use Mautic\LeadBundle\Model\LeadModel;
use Mautic\PageBundle\Entity\Trackable;
use Mautic\PageBundle\Model\RedirectModel;
use Mautic\PageBundle\Model\TrackableModel;
use Mautic\SmsBundle\SmsEvents;
use Mautic\WebhookBundle\Event\WebhookRequestEvent;
use Mautic\WebhookBundle\WebhookEvents;
use MauticPlugin\MauticCustomSmsBundle\CustomSmsEvents;
use MauticPlugin\MauticCustomSmsBundle\Event\TokensBuildEvent;
use MauticPlugin\MauticTwigTemplatesBundle\Helper\TokenHelper;
use MauticPlugin\MauticTwigTemplatesBundle\Service\TwigRender;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class BuilderSubscriber.
 */
class BuilderSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    protected $twigToken = '{twigtemplate=(.*?)}';

    /**
     * @var TokenHelper
     */
    protected $tokenHelper;

    /**
     * @var LeadModel
     */
    protected $leadModel;

    /**
     * @var TwigRender
     */
    private $twig;

    /**
     * @var TrackableModel
     */
    private $trackableModel;

    /**
     * @var RedirectModel
     */
    private $redirectModel;

    /**
     * @var BuilderTokenHelperFactory
     */
    private $builderTokenHelperFactory;

    /**
     * BuilderSubscriber constructor.
     *
     * @param TokenHelper       $tokenHelper
     * @param LeadModel         $leadModel
     * @param TwigRender $twig
     * @param TrackableModel    $trackableModel
     * @param RedirectModel     $redirectModel
     */
    public function __construct(
        TokenHelper $tokenHelper,
        LeadModel $leadModel,
        TwigRender $twig,
        TrackableModel $trackableModel,
        RedirectModel $redirectModel,
        BuilderTokenHelperFactory $builderTokenHelperFactory
    ) {
        $this->tokenHelper    = $tokenHelper;
        $this->leadModel      = $leadModel;
        $this->twig           = $twig;
        $this->trackableModel = $trackableModel;
        $this->redirectModel = $redirectModel;
        $this->builderTokenHelperFactory = $builderTokenHelperFactory;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        $events = [
            EmailEvents::EMAIL_ON_BUILD   => ['onBuilderBuild', 0],
            EmailEvents::EMAIL_ON_SEND    => ['onEmailGenerate', 0],
            EmailEvents::EMAIL_ON_DISPLAY => ['onEmailGenerate', 0],
            SmsEvents::TOKEN_REPLACEMENT  => ['onSmsTokenReplacement', 0],
        ];
        if (defined('MauticPlugin\MauticCustomSmsBundle\CustomSmsEvents::ON_CUSTOM_SMS_TOKENS_BUILD')) {
            $events[CustomSmsEvents::ON_CUSTOM_SMS_TOKENS_BUILD] = ['onCustomSmsTokensBuild', 0];
        }

        if (defined('Mautic\WebhookBundle\WebhookEvents::WEBHOOK_ON_REQUEST')) {
            $events[WebhookEvents::WEBHOOK_ON_REQUEST] = ['onWebhookRequest', 0];
        }

        return $events;
    }

    public function onWebhookRequest(WebhookRequestEvent $event)
    {
        $url = $event->getUrl();
        $headers = $event->getHeaders();
        $payload = $event->getPayload();
        $contact      = $event->getContact();

        $contactData  = $this->appendAdditionalContactData(
            sprintf("%s%s%s", $url, implode('', $headers), implode('', $payload)),
            $contact->getProfileFields(),
            $contact
        );

        $url = $this->replaceTwigTokensInString($url, $contactData);
        $event->setUrl($url);

        $headers = $this->replaceTwigTokensInArrray($headers, $contactData);
        $event->setHeaders($headers);

        $payload = $this->replaceTwigTokensInArrray($payload, $contactData);
        $event->setPayload($payload);
    }

    private function replaceTwigTokensInArrray(array $items, array $contactData)
    {
        foreach ($items as &$item) {
            $item = $this->replaceTwigTokensInString($item, $contactData);
        }

        return $items;
    }

    private function replaceTwigTokensInString(string $string, array $contactData)
    {
        $tokens       = $this->tokenHelper->findTwigTokens($string);
        foreach ($tokens as $key => $content) {
            $string = str_replace($key, $this->twig->getTwig()->createTemplate($content)->render(['contact' => $contactData]), $string);
        }

        return $string;

    }



    /**
     * @param TokensBuildEvent $event
     */
    public function onCustomSmsTokensBuild(TokensBuildEvent $event)
    {
        $tokenHelper = $this->builderTokenHelperFactory->getBuilderTokenHelper('twigTemplates', 'twigTemplates:twigTemplates');

        $tokens      = $tokenHelper->getTokens($this->twigToken, '', 'name', 'id');
        $tokens      = array_merge($event->getTokens(), $tokens);
        $event->setTokens($tokens);

    }

    /**
     * @param BuilderEvent $event
     */
    public function onBuilderBuild(BuilderEvent $event)
    {
        if ($event->tokensRequested($this->twigToken)) {
            $tokenHelper = $this->builderTokenHelperFactory->getBuilderTokenHelper('twigTemplates', 'twigTemplates:twigTemplates');
            $event->addTokensFromHelper($tokenHelper, $this->twigToken, 'name', 'id', false, true);
        }
    }

    /**
     * @param EmailSendEvent $event
     *
     * @throws \Throwable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    public function onEmailGenerate(EmailSendEvent $event)
    {
        if ($event->isDynamicContentParsing()) {
            return;
        }

        $contact     = $event->getLead();
        $channelId   = !is_null($event->getEmail()) ? $event->getEmail()->getId() : null;
        $tokens      = $this->tokenHelper->findTwigTokens($event->getContent().$event->getSubject());
        $contactData = $this->appendAdditionalContactData(implode('', $tokens), $contact);

        foreach ($tokens as $key => $content) {
            $content = $this->twig->getTwig()->createTemplate($content)->render(['contact' => $contactData, 'tokens' =>$event->getTokens() ]);
            $event->addToken($key, $this->generateTrackableUrls($content, 'email', $channelId, $event->generateClickthrough()));
        }
    }

    /**
     * @param TokenReplacementEvent $event
     *
     * @throws \Throwable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    public function onSmsTokenReplacement(TokenReplacementEvent $event)
    {
        $contact      = $event->getLead();
        $tokens       = $this->tokenHelper->findTwigTokens($event->getContent());
        $contactData  = $this->appendAdditionalContactData(
            implode('', $tokens),
            $contact->getProfileFields(),
            $contact
        );
        $clickthrough = $event->getClickthrough();

        foreach ($tokens as $key => $content) {
            $content = $this->twig->getTwig()->createTemplate($content)->render(['contact' => $contactData]);
            $tokens[$key] = $this->generateTrackableUrls(
                $content,
                'sms',
                $clickthrough['channel'][1],
                $clickthrough,
                true
            );;
        }
        $content = str_replace(array_keys($tokens), $tokens, $event->getContent());
        $event->setContent($content);
    }

    /**
     * @param       $content
     * @param       $channel
     * @param null  $channelId
     * @param array $clickthrough
     * @param bool  $shortenUrl
     *
     * @return mixed
     */
    private function generateTrackableUrls(
        $content,
        $channel,
        $channelId = null,
        $clickthrough = [],
        $shortenUrl = false
    ) {
        [$content, $trackables] = $this->trackableModel->parseContentForTrackables(
            $content,
            $clickthrough,
            $channel,
            $channelId
        );

        $tokens = [];
        /**
         * @var string
         * @var Trackable $trackable
         */
        foreach ($trackables as $token => $trackable) {
            $tokens[$token] =  ($trackable instanceof Trackable)
                ?
                $this->trackableModel->generateTrackableUrl($trackable, $clickthrough, $shortenUrl)
                :
                $this->redirectModel->generateRedirectUrl($trackable, $clickthrough, $shortenUrl);
        }

        return str_replace(array_keys($tokens), array_values($tokens), $content);
    }


    /**
     * @param           $content
     * @param array     $contact
     * @param Lead|null $lead
     *
     * @return array
     */
    private function appendAdditionalContactData($content, ?array $contact, Lead $lead = null)
    {
        $contact['tags']     = [];
        $contact['segments'] = [];

        $containTags     = strpos($content, 'contact.tags');
        $containSegments = strpos($content, 'contact.segments');

        if ($containTags === false && $containSegments === false) {
            return $contact;
        }

        if (is_null($lead) && !$lead = $this->leadModel->getEntity($contact['id'])) {
            return $contact;
        }

        if ($containTags !== false) {
            /** @var Tag $tag */
            foreach ($lead->getTags() as $tag) {
                $contact['tags'][$tag->getId()] = $tag->getTag();
            }
        }

        if ($containSegments !== false) {
            $contact['segments'] = $this->leadModel->getLists($lead, false, true);
        }

        return $contact;
    }

}
