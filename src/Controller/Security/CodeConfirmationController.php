<?php

namespace App\Controller\Security;

use App\Entity\Vendor\Vendor;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class CodeConfirmationController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __constructor(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/confirmation/code/{code}', name: 'confirmation_code')]
    public function confirmation(VendorSecurityRepository $vendorSecurityRepository, string $code): Response
    {
        $vendorSecurityRepository = $vendorSecurityRepository->findOneBy(['activationCode' => $code]);
        if (null === $vendorSecurityRepository) {
            return new Response('404');
        }
        $vendor = new Vendor();
        $vendor->setPublished(true);

        $vendorSecurityRepository->setActivationCode(null);

        $em = $this->managerRegistry->getManager();
        $em->persist($vendor);
        $em->flush();
        $this->addFlash('success', 'Вы успешно прошли проверку кодом');

        return $this->redirectToRoute($this->getParameter('app_homepage_route'));
    }
}
