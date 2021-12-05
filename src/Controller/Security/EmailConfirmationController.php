<?php


namespace App\Controller\Security;


use App\Entity\Vendor\VendorSecurity;
use App\Repository\Vendor\VendorSecurityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailConfirmationController extends AbstractController
{
    /**
     * @var \SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface
     */
    private VerifyEmailHelperInterface $verifyEmailHelper;

    /**
     * EmailConfirmationController constructor.
     */
    public function __construct(VerifyEmailHelperInterface $helper)
    {
        $this->verifyEmailHelper = $helper;
    }

    /**
     * @Route("/confirmations/email", name="confirmation_email")
     * @param Request $request
     * @param VendorSecurityRepository $vendorSecurityRepository
     * @return Response
     */
    public function EmailVerifier(Request $request, VendorSecurityRepository $vendorSecurityRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

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
            $this->addFlash('e', $exception->getReason());

            return $this->redirectToRoute('registration');
        }
        $vendorSecurity = new VendorSecurity();
        $vendorSecurity->setPublished(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($vendorSecurity);
        $em->flush();

        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('homepage');
    }


}
