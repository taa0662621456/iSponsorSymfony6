<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmsConfirmationController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route(path: '/confirmation/sms', name: 'confirmation_sms')]
    public function smsCodeConfirmation(Request $request) : Response
    {
        # TODO: use SmsCodeGenerator Service
    }

}
