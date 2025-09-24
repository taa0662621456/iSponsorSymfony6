<?php

namespace App\Controller\Security;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class CodeConfirmationController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route(path: '/confirmation/code/{code}', name: 'confirmation_code')]
    public function confirmation(VendorSecurityRepository $vendorSecurityRepository, string $code): Response
    {
        $vendorSecurity = $vendorSecurityRepository->findOneBy(['activationCode' => $code]);

        if (null === $vendorSecurity) {
            return new Response('404');
        }

        // допустим, VendorSecurity связан с Vendor (OneToOne или ManyToOne)
        $vendor = $vendorSecurity->getVendor();
        if (!$vendor) {
            return new Response('Vendor not found');
        }

        $vendor->setPublished(true);
        $vendorSecurity->setActivationCode(null);

        $em = $this->managerRegistry->getManager();
        $em->flush();

        $this->addFlash('success', 'Вы успешно прошли проверку кодом');

        return $this->redirectToRoute($this->getParameter('app_homepage_route'));
    }
}
