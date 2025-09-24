<?php

namespace App\Controller\Security;

use App\Form\Vendor\VendorLoginType;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

#[AsController]
#[Route('/auth', name: 'auth_')]
class LoginController extends AbstractController
{
    use TargetPathTrait;

    public function __construct(
        private readonly RouterInterface $router,
        private readonly LoggerInterface $logger,
    ) {}

    /**
     * Классическая форма логина (UI)
     */
    #[Route('/login', name: 'login', methods: ['GET','POST'])]
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        if ($error) {
            $this->logger->warning('Login failed', [
                'username' => $lastUsername,
                'error'    => $error->getMessage(),
            ]);
        }

        $response = $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token_id' => 'authenticate',
        ]);

        $response->headers->set('Cache-Control', 'no-store, max-age=0');
        return $response;
    }

    /**
     * Альтернативный layout (signin)
     */
    #[Route('/signin', name: 'signin', methods: ['GET','POST'])]
    public function signin(AuthenticationUtils $utils): Response
    {
        return $this->render('security/signin.html.twig', [
            'last_username' => $utils->getLastUsername(),
            'error'         => $utils->getLastAuthenticationError(),
        ]);
    }

    /**
     * JSON-логин для API
     */
    #[Route('/login/json', name: 'login_json', methods: ['POST'])]
    public function jsonLogin(Request $request): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json([
                'error' => 'Not authenticated',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'username' => $user->getUserIdentifier(),
            'roles'    => $user->getRoles(),
        ]);
    }

    /**
     * Logout
     */
    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout(): void
    {
        throw new RuntimeException(
            'This should never be reached! Symfony handles logout via firewall.'
        );
    }
}