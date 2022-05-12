<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic, Inc
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Controller;

use Mautic\CoreBundle\Controller\AjaxController as CommonAjaxController;
use Mautic\CoreBundle\Helper\ArrayHelper;
use Mautic\CoreBundle\Helper\InputHelper;
use Mautic\LeadBundle\Entity\Lead;
use MauticPlugin\MauticRecommenderBundle\Entity\RecommenderTemplate;
use MauticPlugin\MauticTwigTemplatesBundle\Service\TwigRender;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;

use MauticPlugin\MauticRecommenderBundle\Form\Type\RecommenderTableOrderType;
use Twig\Error\Error;

class AjaxController extends CommonAjaxController
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|void
     * @throws \Throwable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    protected function generateExampleAction(Request $request)
    {
        $data  = [];
        $datas = $request->request->all();
        if (!isset($datas['twigTemplates']) || !isset($datas['contact_search'])) {
            $this->notFound();

            return;
        }
        $template  = ArrayHelper::getValue('template', $datas['twigTemplates']);
        $contactId = ArrayHelper::getValue('contact', $datas['contact_search']);

        if (!$template || !$contactId) {
            return $this->sendJsonResponse($data);
        }

        /** @var TwigRender $twig */
        $twig = $this->get('mautic.twigTemplates.twig.render');
        /** @var Lead $contact */
        if ($contact = $this->getModel('lead')->getEntity($contactId)) {
            try {
                $data['content'] = $twig->getTwig()->createTemplate($template)->render(
                    ['contact' => $contact->getProfileFields()]
                );
            } catch (Error $exception) {
                $data['content'] = sprintf("Error: %s", $exception->getMessage());
            }
        }

        return $this->sendJsonResponse($data);
    }


}
