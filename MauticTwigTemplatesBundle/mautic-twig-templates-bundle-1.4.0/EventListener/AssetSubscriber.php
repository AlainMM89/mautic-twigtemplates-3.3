<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\EventListener;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\CustomAssetsEvent;
use MauticPlugin\MauticTwigTemplatesBundle\Integration\TwigTemplatesSettings;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AssetSubscriber implements EventSubscriberInterface
{
    /**
     * @var TwigTemplatesSettings
     */
    private $templatesSettings;

    public function __construct(TwigTemplatesSettings $templatesSettings)
    {
        $this->templatesSettings = $templatesSettings;
    }

    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::VIEW_INJECT_CUSTOM_ASSETS => ['injectAssets', -5],
        ];
    }

    /**
     * @param CustomAssetsEvent $assetsEvent
     */
    public function injectAssets(CustomAssetsEvent $assetsEvent)
    {
        if ($this->templatesSettings->isEnabled()) {
            $assetsEvent->addScript('plugins/MauticTwigTemplatesBundle/Assets/js/twigtemplates.js');
        }
    }
}
