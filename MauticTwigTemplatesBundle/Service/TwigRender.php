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

class TwigRender
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * TwigRender constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        // TWIG filter json_decode
        $twig->addFilter(new \Twig_SimpleFilter('json_decode', function ($string) {
            return json_decode($string, true);
        }));
        $this->twig = $twig;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }

}

