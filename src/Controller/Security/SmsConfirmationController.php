<?php


namespace App\Controller\Security;


use App\Entity\Vendor\VendorCodeStorage;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmsConfirmationController extends AbstractController
{
    /**
     * @Route("/smsConfirmation", name="sms_confirmation")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function smsCodeConfirmation(Request $request): Response
    {
        # TODO: use SmsCodeGenerator Service
    }

}
