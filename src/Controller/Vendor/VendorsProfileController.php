<?php
declare(strict_types=1);

namespace App\Controller\Vendor;

use App\Repository\Vendor\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vendors/profile")
 * @Route("/sponsor/profile")
 */
class VendorsProfileController
	extends AbstractController
{
	/**
	 * @Route( "/{slug}", name="profile", methods={"GET","POST"})
	 * @Route( "/{id<\d+>}", name="profile", methods={"GET","POST"})
	 * @param VendorRepository $vendorsRepository
	 *
	 * @return Response
	 */
	public function index(VendorRepository $vendorsRepository): Response
	{
		/**
		 * TODO: проверка "на админа" (только админ и выше может с фронта запрашивать по ИД)
		 * если админ и в 'id'
		 */
		/*if ($id)
		{
		return $this->render('vendor/vendors_profile/profile.html.twig', array(
            'vendor' => $vendorsRepository->findBy(
                array('id' => $this->getUser())
            ),
        ));

		}*/

		/**
		 * TODO: в противном случае возвращать по 'slug'
		 */
		return $this->render(
			'vendor/vendors_profile/profile.html.twig', array(
			'vendor' => $vendorsRepository->findBy(
				array('slug' => $this->getUser())
			),
		)
		);


	}
}
