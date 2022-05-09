<?php

namespace MauticPlugin\MauticBeefreeBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BeefreeTestEmailController extends CommonController
{
    public function sendAction(Request $request){

        // set header
        header('Access-Control-Allow-Origin: *');

        // get data
        $data = json_decode($request->getContent());
        $html = $data->html;
        $toEmail = $data->toEmail;

        // get mailer helper
        $mailer = $this->get('mautic.helper.mailer')->getMailer();

        // To address; can use setTo(), addCc(), setCc(), addBcc(), or setBcc() as well
        $mailer->addTo($toEmail);

        // Set content
        $mailer->setBody($html);

        // Send the mail, pass true to dispatch through event listeners (for replacing tokens, etc)
        if ($mailer->send(true)) {
            $status = true;
        } else {
            $errors = $mailer->getErrors();
            $failedRecipients = $errors['failures'];
            $status = false;
        }

        // create response
        $response = new JsonResponse([
            'success' => $status,
        ]);

        // set header
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }
}