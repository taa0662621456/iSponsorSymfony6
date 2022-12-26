<?php


namespace App\Controller\Security;


use App\Form\Vendor\VendorLoginType;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

#[AsController]
class LoginController extends AbstractController
{
    use TargetPathTrait;

    public function __construct(private readonly RouterInterface $router)
    {
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route(path: '/signin', name: 'signin', options: ['layout' => 'signinFormHomePage'], defaults: ['layout' => 'signin'], methods: ['GET', 'POST'])]
    #[Route(path: '/login', name: 'login', options: ['layout' => 'login'], defaults: ['layout' => 'login'], methods: ['GET', 'POST'])]
    public function login(Security $security, AuthenticationUtils $authenticationUtils, string $layout = 'login') : Response
    {
        if (null !== $this->getUser()) {
            $this->addFlash('success', 'Вы успешно авторизовались');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('success', 'Вы успешно авторизовались');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }

        $loginType = $this->container->get('form.factory')->createNamed('', VendorLoginType::class,
            [
            '_username' => $authenticationUtils->getLastUsername()
            ],
            [
            'action' => $this->router->generate($this->getParameter('app_login_route'))
            ]
        );

        return $this->render(
            'security/' . $layout . '.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'form'          => $loginType->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout() : void
    {
        throw new RuntimeException('This should never be reached!');
        //		throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall!');
    }

    #[Route(path: '/login/json', name: 'login_json', methods: ['POST'])]
    public function jsonLogin(Request $request) : JsonResponse
    {
        $user = $this->getUser();
        return $this->json(
            [
                'username' => $user->getUserIdentifier(),
                'roles'    => $user->getRoles(),
            ]
        );
    }

}
