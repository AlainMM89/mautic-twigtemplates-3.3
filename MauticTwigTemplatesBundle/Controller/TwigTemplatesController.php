<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Controller;

use Mautic\CoreBundle\Controller\AbstractStandardFormController;
use Mautic\PluginBundle\Helper\IntegrationHelper;
use MauticPlugin\MauticTwigTemplatesBundle\Service\ContactSearch;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwigTemplatesController extends AbstractStandardFormController
{

    /**
     * {@inheritdoc}
     */
    protected function getJsLoadMethodPrefix()
    {
        return 'twigTemplates';
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelName()
    {
        return 'twigTemplates.twigTemplates';
    }

    /**
     * {@inheritdoc}
     */
    protected function getRouteBase()
    {
        return 'twigTemplates';
    }

    /***
     * @param null $objectId
     *
     * @return string
     */
    protected function getSessionBase($objectId = null)
    {
        return 'twigTemplates'.(($objectId) ? '.'.$objectId : '');
    }

    /**
     * @return string
     */
    protected function getControllerBase()
    {
        return 'MauticTwigTemplatesBundle:TwigTemplates';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function batchDeleteAction()
    {
        return $this->batchDeleteStandard();
    }

    /**
     * @param $objectId
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function cloneAction($objectId)
    {
        return $this->cloneStandard($objectId);
    }

    /**
     * @param      $objectId
     * @param bool $ignorePost
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function editAction($objectId, $ignorePost = false)
    {
        return $this->editStandard($objectId, $ignorePost);
    }

    /**
     * @param int $page
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction($page = 1)
    {
        return $this->indexStandard($page);
    }

    /**
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function newAction()
    {
        return $this->newStandard();
    }

    /**
     * @param $objectId
     *
     * @return array|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($objectId)
    {
        $page      = 1;
        $returnUrl = $this->generateUrl('mautic_twigTemplates_index', ['page' => $page]);
        return $this->postActionRedirect(
            [
                'returnUrl'       => $returnUrl,
                'viewParameters'  => ['page' => $page],
                'contentTemplate' => 'MauticTwigTemplatesBundle:TwigTemplates:index',
                'passthroughVars' => [
                    'activeLink'    => '#mautic_twigTemplates_index',
                    'mauticContent' => 'twigTemplates',
                ],
            ]
        );
    }

    /**
     * @param $args
     * @param $action
     *
     * @return mixed
     */
    protected function getViewArguments(array $args, $action)
    {
        $viewParameters = [];
        switch ($action) {
            case 'edit':
                /** @var ContactSearch $contactSearch */
                $contactSearch = $this->get('mautic.twigTemplates.contact.search');
                $contactSearch->setObjectId($args['objectId']);;
                $viewParameters['tester'] = $this->renderView('MauticTwigTemplatesBundle:TwigTemplates:example.html.php', $contactSearch->getViewParameters());
                break;
            case 'view':
                break;
        }
        $args['viewParameters'] = array_merge($args['viewParameters'], $viewParameters);

        return $args;
    }


    /**
     * @param $objectId
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function deleteAction($objectId)
    {
        return $this->deleteStandard($objectId);
    }

    protected function getDefaultOrderColumn()
    {
        return 'id';
    }


    /**
     * @param $objectId
     *
     * @return mixed
     */
    public function exampleAction($objectId)
    {
        return $this->get('mautic.twigTemplates.contact.search')->delegateForm($objectId, $this);
    }

    /**
     * @param array $args
     * @param       $action
     *
     * @return array
     */
    protected function getPostActionRedirectArguments(array $args, $action)
    {
        switch ($action) {
            case 'new':
            case 'edit':
            if ($this->request->getMethod() === 'POST') {
                $this->request->request->remove('search');
            }
            break;
        }

        return $args;
    }
}
