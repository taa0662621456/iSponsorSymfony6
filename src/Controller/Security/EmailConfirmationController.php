<?php


namespace App\Controller\Security;


use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class EmailConfirmationController extends AbstractController
{
    #[Route('/confirmation/email', name: 'email_confirmation')]
    public function verifyUserEmail(Request $request, VendorSecurityRepository $vendorSecurityRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('registration');
        }

        $vendor = $vendorSecurityRepository->find($id);

        if (null === $vendor) {
            return $this->redirectToRoute('registration');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $vendor);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('registration');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('registration');
    }


}
