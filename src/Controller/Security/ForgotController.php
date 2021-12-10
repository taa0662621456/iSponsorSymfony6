<?php


namespace App\Controller\Security;


use App\Form\Security\SecurityForgotEmailType;
use App\Form\Security\SecurityForgotPasswordType;
use App\Form\Security\SecurityForgotPhoneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ForgotController extends AbstractController
{
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    /**
     * LoginController constructor.
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/forgot/email", name="forgot_email")
     * @param \Symfony\Component\Security\Core\Security $security
     * @param \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function forgotEmail(Security $security, AuthenticationUtils $authenticationUtils): Response
    {
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }

        $securityForgotEmailType = $this->get('form.factory')->createNamed('', SecurityForgotEmailType::class,
            [
                '_username' => $authenticationUtils->getLastUsername()
            ],
            [
                'action' => $this->router->generate('forgot_email')
            ]
        );

        return $this->render(
            'security/forgot.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'form'          => $securityForgotEmailType->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

    /**
     * @Route("/forgot/phone", name="forgot_phone")
     * @param \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function forgotPhone(Security $security, AuthenticationUtils $authenticationUtils): Response
    {
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }

        $securityForgotEmailType = $this->get('form.factory')->createNamed('', SecurityForgotPhoneType::class,
            [
                '_username' => $authenticationUtils->getLastUsername()
            ],
            [
                'action' => $this->router->generate('forgot_email')
            ]
        );

        return $this->render(
            'security/forgot.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'form'          => $securityForgotEmailType->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

    /**
     * @Route("/forgot/password", name="forgot_password")
     * @param \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function forgotPassword(Security $security, AuthenticationUtils $authenticationUtils): Response
    {
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }

        $securityForgotEmailType = $this->get('form.factory')->createNamed('', SecurityForgotPasswordType::class,
            [
                '_username' => $authenticationUtils->getLastUsername()
            ],
            [
                'action' => $this->router->generate('forgot_email')
            ]
        );

        return $this->render(
            'security/forgot.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'form'          => $securityForgotEmailType->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

}
