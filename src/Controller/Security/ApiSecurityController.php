<?php

namespace App\Controller\Security;

use App\Entity\Vendor\VendorSecurity;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[AsController]
class ApiSecurityController extends AbstractController
{



    #[Route(path: '/api/signin', name: 'api_signin', options: [], defaults: [], methods: ['GET', 'POST'])]
	#[Route(path: '/api/login', name: 'api_login', options: [], defaults: [], methods: ['GET', 'POST'])]
	public function login(#[CurrentUser] ?VendorSecurity $user) : Response
	{
		if (null === $user) {
      return $this->json([
          'message' => 'missing credentials',
          ], Response::HTTP_UNAUTHORIZED);
   }
		$token = '...';
		// somehow create an API token for $user
		return $this->json([
				'message' => 'Welcome to your new controller!',
          'path' => 'src/Controller/ApiSecurityController.php',
          'user'  => $user->getUserIdentifier(),
          'token' => $token
      ]
		);
	}
}
