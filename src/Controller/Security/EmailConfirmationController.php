<?php


namespace App\Controller\Security;


use App\Entity\Vendor\VendorSecurity;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailConfirmationController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    /**
     * EmailConfirmationController constructor.
     */
    public function __construct(private readonly VerifyEmailHelperInterface $verifyEmailHelper, ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route(path: '/confirmation/email', name: 'confirmation_email')]
    public function confirmationEngine(Request $request, VendorSecurityRepository $vendorSecurityRepository) : Response
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
