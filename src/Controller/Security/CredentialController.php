<?php

namespace App\Controller\Security;

use App\Service\Security\SecurityGenerator;
use Exception;
use ReCaptcha\ReCaptcha;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorSecurity;
use App\Event\Vendor\RegisteredEvent;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\ConfirmationCodeGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class CredentialController extends AbstractController
{
    /**
     * CredentialController constructor.
     */
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher, private readonly ManagerRegistry $managerRegistry)
    {
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/change', name: 'change_security', methods: ['GET', 'POST'])]
    public function change(Request $request, ConfirmationCodeGenerator $codeGenerator, EventDispatcherInterface $eventDispatcher): Response
    {
        $recaptcha = new ReCaptcha($this->getParameter('app_google_recaptcha_secret'));
        $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorCurrent = $this->getUser();
        $form = $this->createForm(SecurityGenerator::class);
        $form->handleRequest($request);
        if (!$resp->isSuccess()) {
            foreach ($resp->getErrorCodes() as $errorCode) {
                $this->addFlash('danger', 'Error captcha: '.$errorCode);
            }
        } else {
            $formData = $form->getData();
            $password = $this->passwordHasher->hashPassword(
                $vendorSecurity,
                $formData->getVendorSecurity()->getPlainPassword()
            );
            // $vendor->setEmail();  Хочу добавить в область безопасности смену меил

            $vendorSecurity->setActivationCode($codeGenerator->getConfirmationCode());

            $em = $this->managerRegistry->getManager();
            $em->persist($vendorSecurity);
            $em->persist($vendor);

            $em->flush();

            $vendorRegisteredEvent = new RegisteredEvent($vendorSecurity);
            $eventDispatcher->dispatch($vendorRegisteredEvent);

            $this->addFlash('success', 'Success. Успешно изменили параметры безопасности');

            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('change_security');
        }

        return $this->render(
            'security/change.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
