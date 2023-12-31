<?php

namespace App\Controller\Security;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

#[AsController]
class EmailConfirmationController extends AbstractController
{
    /**
     * EmailConfirmationController constructor.
     */
    public function __construct(private readonly VerifyEmailHelperInterface $verifyEmailHelper, private readonly ManagerRegistry $managerRegistry)
    {
    }

    #[Route(path: '/confirmation/email', name: 'confirmation_email')]
    public function confirmationEngine(Request $request, VendorSecurityRepository $vendorSecurityRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var VendorSecurity $user */
        $user = $this->getUser();
        $id = $request->get('id');
        $slug = $request->get('slug');
        if (null === $slug) {
            return $this->redirectToRoute('homepage');
        }
        $user = $vendorSecurityRepository->findOneBy(['slug' => $slug]);
        if (null === $user) {
            return $this->redirectToRoute('homepage');
        }
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('error', $exception->getReason());

            return $this->redirectToRoute('registration');
        }
        $vendorSecurity = $vendorSecurityRepository->findOneBy(['slug' => $slug]);
        $vendorSecurity->setPublished(true);
        $em = $this->managerRegistry->getManager();
        $em->persist($vendorSecurity);
        $em->flush();
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('homepage');
    }
}
