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
     * @Route("/confirmation/code/{code}", name="confirmation_code")
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

        $vendor->setPublished(true);
        #
        $vendorSecurityRepository->setActivationCode(null);
        #
        $em = $this->getDoctrine()->getManager();
        $em->persist($vendor);
        $em->flush();

        $this->addFlash('success', 'Вы успешно прошли проверку кодом');
        return $this->redirectToRoute($this->getParameter('app_homepage_route'));
    }

}
