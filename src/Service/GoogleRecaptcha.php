<?php


namespace App\Service;


use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class GoogleRecaptcha
{
    private ParameterBag $parameterBag;

    /**
     * GoogleRecaptcha constructor.
     */
    public function __construct(ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;

    }

    public function recaptchaResponse(Request $request): \ReCaptcha\Response
    {
        $recaptchaKey = $this->parameterBag->get('app_google_recaptcha_key');
        $recaptcha = new ReCaptcha($recaptchaKey);
        return $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

    }
}
