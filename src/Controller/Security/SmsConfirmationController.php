<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class SmsConfirmationController extends AbstractController
{
    /**
     *
     * @return JsonResponse
     */
    #[Route(path: '/confirmation/sms', name: 'confirmation_sms')]
    public function smsCodeConfirmation(Request $request) : Response
    {
        # TODO//: use SmsCodeGenerator Service
        return 'TODO: use SmsCodeGenerator Service';
    }

}
