<?php

namespace App\Controller\Security;

use App\Form\Vendor\VendorSecurityType;
use App\Service\EmailConfirmation;
use App\Service\RegistrationManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Twig\Environment;

#[AsController]
#[Route('/auth/register', name: 'auth_register_')]
class RegistrationController extends AbstractController
{
    use TargetPathTrait;

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger,
        private readonly Environment $twig,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly FormFactoryInterface $formFactory,
        private readonly EmailConfirmation $emailConfirmation,
        private readonly ManagerRegistry $managerRegistry,
    ) {}

    #[Route('/auth/registration', name: 'auth_register')]
    public function registration(Request $request, RegistrationManager $manager): Response
    {
        $form = $this->createForm(VendorSecurityType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $vendorSecurity = $manager->registerVendor($form->getData());
                $this->addFlash('success', 'Регистрация успешна. Подтвердите email.');
                return $this->redirectToRoute('auth_login');
            } catch (\Throwable $e) {
                $this->addFlash('danger', 'Ошибка регистрации');
            }
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

}