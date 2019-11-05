<?php
declare(strict_types=1);

namespace App\Controller\Vendor;

use App\Repository\Vendor\VendorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class VendorsProfileController
	extends AbstractController
{
	/**
	 * @Route( "/", name="profile", methods={"GET","POST"})
	 * @param VendorsRepository $vendorsRepository
	 *
	 * @return Response
	 */
	public function index(VendorsRepository $vendorsRepository): Response
	{

		return $this->render('vendor/vendors_profile/profile.html.twig', array(
            'vendor' => $vendorsRepository->findBy(
                array('id' => $this->getUser())
            ),
        ));
    }
}
