<?php


namespace App\Controller\Security;


use App\Entity\Vendor\Vendor;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CodeConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmations/{code}", name="code_confirmation")
     * @param VendorSecurityRepository $vendorSecurityRepository
     * @param string $code
     * @return Response
     * @throws \Exception
     */
    public function confirmation(VendorSecurityRepository $vendorSecurityRepository, string $code): Response
    {
        $vendorSecurityRepository = $vendorSecurityRepository->findOneBy(['activationCode' => $code]);

        if ($vendorSecurityRepository === null) {
            return new Response('404');
        }

        $vendor = new Vendor();

        $vendor->setIsActive(true);
        #
        $vendorSecurityRepository->setActivationCode('');
        #
        $em = $this->getDoctrine()->getManager();
        $em->persist($vendor);
        $em->flush();

        return $this->render('security/confirmed.html.twig', [
            'vendor' => $vendorSecurityRepository,
        ]);
    }

}
