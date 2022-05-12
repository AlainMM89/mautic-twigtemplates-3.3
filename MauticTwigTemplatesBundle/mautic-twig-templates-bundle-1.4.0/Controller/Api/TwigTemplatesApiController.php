<?php

/*
 * @copyright   2021 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Controller\Api;

use Mautic\ApiBundle\Controller\CommonApiController;
use MauticPlugin\MauticTwigTemplatesBundle\Entity\TwigTemplates;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;


class TwigTemplatesApiController extends CommonApiController
{
    public function initialize(FilterControllerEvent $event)
    {
        parent::initialize($event);

        $this->model           = $this->getModel('twigTemplates');
        $this->entityClass     = TwigTemplates::class;
        $this->entityNameOne   = 'twigTemplate';
        $this->entityNameMulti = 'twigTemplates';
        $this->permissionBase  = 'twigTemplates:twigTemplates';
        $this->dataInputMasks  = [
            'html'   => 'html',
            'editor' => 'html',
        ];
    }
}
