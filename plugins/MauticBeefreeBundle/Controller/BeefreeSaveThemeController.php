<?php

namespace MauticPlugin\MauticBeefreeBundle\Controller;

use MauticPlugin\MauticBeefreeBundle\Entity\BeefreeTheme;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Mautic\CoreBundle\Controller\CommonController;


class BeefreeSaveThemeController extends CommonController
{
    public function saveThemeAction(Request $request)
    {
        // set header
        header('Access-Control-Allow-Origin: *');

        // get data
        $data = json_decode($request->getContent());
        $content = $data->content;
        $preview = $data->html;
        $template_name = $data->template_name;
        $template_title = $data->template_title;

        // get bfrepo
        $bfrepo = $this->getDoctrine()->getRepository(BeefreeTheme::class);

        // new
        $id = null;

        // create new theme
        $bfrepo->saveBeefreeTheme($id, $template_name, $template_title, $preview, $content);

        // create response
        $response = new JsonResponse([
            'success' => true,
        ]);

        // set header
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}