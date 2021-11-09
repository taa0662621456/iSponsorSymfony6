<?php

namespace App\Controller;

use App\Entity\Vendor\VendorSecurity;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiSecurityController extends AbstractController
{



    /**
     * @Route("/api/signin", defaults={}, name="api_signin", options={},
     *     methods={"GET", "POST"})
     * @Route("/api/login", defaults={}, name="api_login", options={},
     *     methods={"GET", "POST"})
     *
     * @param \App\Entity\Vendor\VendorSecurity|null $user
     * @return Response
     */
	public function login(#[CurrentUser] ?VendorSecurity $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
                ], Response::HTTP_UNAUTHORIZED);
         }

        $token = '...'; // somehow create an API token for $user

        return $this->json([
				'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/ApiSecurityController.php',
                'user'  => $user->getUserIdentifier(),
                'token' => $token
            ]
		);
	}
}
