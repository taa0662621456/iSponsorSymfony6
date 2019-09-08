<?php
declare(strict_types=1);

namespace App\Controller\Profile;

use App\Repository\VendorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Profile
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route( "/profile", name="profile", methods={"GET","POST"})
     * @param VendorsRepository $vendorsRepository
     * @return Response
     */
    public function index(VendorsRepository $vendorsRepository): Response
    {

        return $this->render('profile/index.html.twig', array(
            'vendor' => $vendorsRepository->findBy(
                array('id' => $this->getUser())
            ),
        ));
    }
}
