<?php

namespace App\Service;

use ReCaptcha\Response;
use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\Request;

class GoogleRecaptcha
{
    public function recaptchaResponse(Request $request, $secret, $requestMethod): Response
    {
        $recaptcha = new ReCaptcha($secret, $requestMethod);

        return $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
    }
}
