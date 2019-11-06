<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Vendor\Vendors;
use App\Event\RegisteredEvent;
use App\Form\SecurityChangePasswordType;
use App\Form\Vendor\VendorsLoginType;
use App\Form\Vendor\VendorsRegistrationType;
use App\Repository\Vendor\VendorsRepository;
use App\Service\ConfirmationCodeGenerator;
use Exception;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Twig_Environment;

class SecurityController
	extends AbstractController
{
	use TargetPathTrait;

	/**
	 * @var Twig_Environment $twig
	 */
	private $twig;

	public function __construct(
		Twig_Environment $twig
	)
	{
		$this->twig = $twig;
	}

	/**
	 * @Route("/registration", name="registration")
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @param Request                      $request
	 * @param ConfirmationCodeGenerator    $codeGenerator
	 * @param EventDispatcherInterface     $eventDispatcher
	 *
	 * @return Response
	 * @throws Exception
	 */
	public function registration(UserPasswordEncoderInterface $passwordEncoder, Request $request,
								 ConfirmationCodeGenerator $codeGenerator,
								 EventDispatcherInterface $eventDispatcher): Response
	{
		$vendor = new Vendors();

		$form = $this->createForm(VendorsRegistrationType::class);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$vendor = $form->getData();

			$password = $passwordEncoder->encodePassword(
				$vendor,
				$vendor->getPlainPassword()
			);

			$vendor->setPassword($password);
			$vendor->setActivationCode($codeGenerator->getConfirmationCode());

			$em = $this->getDoctrine()->getManager();
            $em->persist($vendor);
            $em->flush();

			$vendorRegisteredEvent = new RegisteredEvent($vendor);
			$eventDispatcher->dispatch($vendorRegisteredEvent);
        }

        return $this->render('security/registration.html.twig', [
			'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/confirm/{code}", name="email_confirmation")
     * @param VendorsRepository $vendorsRepository
     * @param string $code
     * @return Response
     */
    public function confirmation(VendorsRepository $vendorsRepository, string $code): Response
    {

		$vendor = $vendorsRepository->findOneBy(['activationCode' => $code]);

		if ($vendor === null) {
			return new Response('404');
		}

		$vendor->setActive(true);
		$vendor->setActivationCode('');

		$em = $this->getDoctrine()->getManager();

		$em->flush();

		return $this->render('security/confirmed.html.twig', [
			'vendor' => $vendor,
		]);
	}

	/**
	 * @Route("/login", defaults={"layout" : "login"}, name="login", options={"layout" : "loginFormHomePage"},
	 *     methods={"GET", "POST"})
	 * @param Request             $request
	 * @param Security            $security
	 *
	 * @param AuthenticationUtils $authenticationUtils
	 * @param                     $layout
	 *
	 * @return Response
	 */
	public function login(Request $request, Security $security, AuthenticationUtils $authenticationUtils, $layout): Response
	{
		if ($security->isGranted('ROLE_USER')) {
			return $this->redirectToRoute('homepage');
		}

		$this->saveTargetPath($request->getSession(), 'main', $this->generateUrl('homepage'));

		$lastUsername = $authenticationUtils->getLastUsername();
		$error = $authenticationUtils->getLastAuthenticationError();

		$form = $this->createForm(VendorsLoginType::class);

		/*return new Response(
			$this->twig->render(
				'security/' . $layout . '.html.twig', array(
				'last_username' => $lastUsername,
				'form'          => $form->createView(),
				'error'         => $error
			)
			)
		);*/

		return $this->render(
			'security/' . $layout . '.html.twig', array(
				'last_username' => $lastUsername,
				'form'          => $form->createView(),
				'error'         => $error
			)
		);
	}

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        throw new RuntimeException('This should never be reached!');
    }

    /**
     * @Route("/change-password", methods={"GET", "POST"}, name="change_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function change(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $vendor = $this->getUser();
        $form = $this->createForm(SecurityChangePasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$vendor->setEmail();  Хочу добавить в область безопастности смену Емаил
            $vendor->setPassword($encoder->encodePassword($vendor, $form->get('newPassword')->getData()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('change_password');
        }
        return $this->render('security/change.html.twig', [
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/admin")
	 * @Route("/administrator")
	 */
	public function admin()
	{
		return new Response('<html lang="en"><body>Admin page!</body></html>');
	}

	/**
	 * @Route("/login/json", name="login_json", methods={"POST"})
	 * @param Request $request
	 *
	 * @return mixed|JsonResponse
	 */
	public function jsonLogin(Request $request)
	{
		$user = $this->getUser();

		return $this->json(
			array(
				'username' => $user->getUsername(),
				'roles'    => $user->getRoles(),
			)
		);
	}

	/**
	 * @Route("/forgot", name="forgot")
	 * @return Response
	 */
	public function forgot()
	{
		return new Response('<html lang="en"><body>Are You forgot any auth parameters?</body></html>');
	}
}