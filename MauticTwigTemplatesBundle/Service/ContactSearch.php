<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Service;


use Mautic\CoreBundle\Controller\CommonController;
use Mautic\CoreBundle\Helper\CookieHelper;
use Mautic\LeadBundle\Model\LeadModel;
use MauticPlugin\MauticTwigTemplatesBundle\Form\Type\ContactSearchType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

class ContactSearch
{
    CONST COOKIENAME = 'mautic.twigTemplates.form.example';

    /**
     * @var RequestStack
     */
    private $request;

    /** @var \Symfony\Component\HttpFoundation\ParameterBag */
    private $cookies;

    /**
     * @var CookieHelper
     */
    private $cookieHelper;

    /** @var  int */
    private $objectId;
    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var LeadModel
     */
    private $leadModel;

    /**
     * ContactSearch constructor.
     *
     * @param RequestStack    $requestStack
     * @param CookieHelper    $cookieHelper
     * @param FormFactory     $formFactory
     * @param RouterInterface $router
     * @param LeadModel       $leadModel
     */
    public function __construct(
        RequestStack $requestStack,
        CookieHelper $cookieHelper,
        FormFactory $formFactory,
        RouterInterface $router,
        LeadModel $leadModel

    ) {

        $this->request      = $requestStack->getCurrentRequest();
        $this->cookies      = $this->request->cookies;
        $this->cookieHelper = $cookieHelper;
        $this->formFactory  = $formFactory;
        $this->router       = $router;
        $this->leadModel = $leadModel;
    }

    /**
     * @return array
     */
    private function getChoices()
    {
        $leads       = $this->leadModel->getEntities($this->getEntitiesArgs());
        $leadChoices = [];
        foreach ($leads as $l) {
            $leadChoices[$l->getId()] = $l->getPrimaryIdentifier();
        }

        return $leadChoices;
    }

    public function getForm()
    {
        return $this->formFactory->create(
            ContactSearchType::class,
            [
                'search'  => $this->getSearch(),
                'contact' => $this->getContact(),
            ],
            [
                'action'  => $this->getAction(),
                'choices' => $this->getChoices(),

            ]
        );
    }

    public function getEntitiesArgs()
    {

        $filter           = ['force' => [['column' => 'l.email', 'expr' => 'neq', 'value' => '']]];
        $filter['string'] = $this->getSearch();

        return [
            'limit'          => 25,
            'filter'         => $filter,
            'orderBy'        => 'l.firstname,l.lastname,l.company,l.email',
            'orderByDir'     => 'ASC',
            'withTotalCount' => false,
        ];
    }

    /**
     * @param                  $objectId
     * @param CommonController $controller
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderForm($objectId, CommonController $controller)
    {
        $this->objectId = $objectId;

        return $controller->renderView(
            'MauticTwigTemplatesBundle:TwigTemplates:example.html.php',
            $this->getViewParameters()
        );
    }

    /**
     * @param                  $objectId
     * @param CommonController $controller
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delegateForm($objectId, CommonController $controller)
    {
        $this->objectId = $objectId;

        return $controller->delegateView(
            [
                'viewParameters'  => $this->getViewParameters(),
                'contentTemplate' => 'MauticTwigTemplatesBundle:TwigTemplates:example.html.php',
            ]
        );
    }

    /**
     * @return array
     */
    public function getViewParameters()
    {

        $this->cookieHelper->setCookie(
            md5(self::COOKIENAME),
            serialize(['search' => $this->getSearch(), 'contact' => $this->getContact()]),
            3600 * 24 * 31 * 365
        );

        return [
            'tmpl'        => $this->getTmpl(),
            'searchValue' => $this->getSearch(),
            'action'      => $this->getAction(),
            'form'        => $this->getForm()->createView(),
            'contactId'   => $this->getContact(),

        ];
    }

    /**
     * Get action of url for example
     *
     * @return string
     */
    private function getAction()
    {
        return $this->router->generate(
            'mautic_twigTemplates_action',
            ['objectAction' => 'example', 'objectId' => $this->objectId]
        );
    }


    /**
     * Get unserialized content from cookie
     *
     * @param null|string $key
     *
     * @return array|string
     */
    private function getSavedData($key = null)
    {
        $savedData = unserialize($this->cookies->get(md5(self::COOKIENAME)));
        if (!is_array($savedData)) {
            $savedData = [];
        }
        if ($key) {
            return isset($savedData[$key]) ? $savedData[$key] : '';
        }

        return $savedData;
    }

    /**
     * Get search
     *
     * @return string
     */
    private function getSearch()
    {
        return $this->request->get('search', $this->getSavedData('search'));
    }

    /**
     * Get contact ID from form
     *
     * @return string
     */
    private function getContact()
    {
        return isset($this->request->get('contact_search')['contact']) ? $this->request->get(
            'contact_search'
        )['contact'] : $this->getSavedData('contact');
    }

    /**
     * Get template type
     *
     * @return string
     */
    private function getTmpl()
    {
        return $this->request->get('tmpl', 'index');
    }

    /**
     * @param int $objectId
     */
    public function setObjectId(int $objectId): void
    {
        $this->objectId = $objectId;
    }


}

