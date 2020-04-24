<?php
declare(strict_types=1);

namespace App\Controller;

use App\Doctrine\UuidEncoder;
use App\Entity\SmsCodeSendStorage;
use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsSecurity;
use App\Event\RegisteredEvent;
use App\Form\SecurityChangePasswordType;
use App\Form\Vendor\VendorsLoginType;
use App\Form\Vendor\VendorsRegistrationType;
use App\Repository\Vendor\VendorsRepository;
use App\Repository\Vendor\VendorsSecurityRepository;
use App\Service\ConfirmationCodeGenerator;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;
use ReCaptcha\ReCaptcha;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Twig_Environment;

/**
 * @Route("/vendor")
 * @Route("/sponsor")
 * @Route("/user")
 *
 * @package App\Controller
 */
class SecurityController
	extends AbstractController
{
	use TargetPathTrait;

	/**
	 * @var Twig_Environment $twig
	 */
	private $twig;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var FormFactory
     */
    private $formFactory;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
		Twig_Environment $twig,
        UserPasswordEncoderInterface $passwordEncoder,
        FormFactoryInterface $formFactory,
        RouterInterface $router
	)
	{
		$this->twig = $twig;
		$this->passwordEncoder = $passwordEncoder;
		$this->formFactory = $formFactory;
		$this->router = $router;
	}

    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param ConfirmationCodeGenerator $codeGenerator
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return Response
     * @throws Exception
     */
	public function registration(Request $request,
								 ConfirmationCodeGenerator $codeGenerator,
								 EventDispatcherInterface $eventDispatcher): Response
	{
		//$recaptcha = new ReCaptcha($this->getParameter('google_recaptcha_site_key'));
		//$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
		$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();
		$vendorEnGb = new VendorsEnGb();

		$form = $this->createForm(VendorsRegistrationType::class, $vendor);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
/*
			if (!$resp->isSuccess()) {
				foreach ($resp->getErrorCodes() as $errorCode) {
					$this->addFlash('danger', 'Error captcha: ' . $errorCode);
				}
			} else {
*/
				$formData = $form->getData();
				$password = $this->passwordEncoder->encodePassword(
				    $vendorSecurity,
					$formData->getVendorSecurity()->getPlainPassword()
				);

				$slug = new UuidEncoder();

				try {
					$uuid = Uuid::uuid4();
					$slug = $slug->encode($uuid);

					$vendor->setUuid($uuid);
					$vendor->setSlug($slug);

					$vendorSecurity->setUuid($uuid);
					$vendorSecurity->setSlug($slug);
					$vendorSecurity->setEmail($formData->getVendorSecurity()->getEmail());
					$vendorSecurity->setPhone($formData->getVendorSecurity()->getPhone());


					$vendorEnGb->setUuid($uuid);
					$vendorEnGb->setSlug($slug);
					$vendorEnGb->setVendorPhone($formData->getVendorSecurity()->getPhone());

				} catch (Exception $e) {
				}
				$vendor->setVendorSecurity($vendorSecurity);
				$vendorSecurity->setPassword($password);
				$vendorSecurity->setActivationCode($codeGenerator->getConfirmationCode());
				$vendor->setVendorEnGb($vendorEnGb);
				$vendorEnGb->setVendorZip(000000);
				$em = $this->getDoctrine()->getManager();
				$em->persist($vendorEnGb);
				$em->persist($vendorSecurity);
				$em->persist($vendor);
				$em->flush();
				$vendorRegisteredEvent = new RegisteredEvent($vendor);
				$eventDispatcher->dispatch($vendorRegisteredEvent);
				$this->addFlash('success', 'Success');
                /*return $guardHandler->authenticateUserAndHandleSuccess(
                $vendorSecurity,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml);*/
			}
//		}

		return $this->render('security/registration.html.twig', [
			'form' => $form->createView(),
		]);

	}

    /**
     * @Route("/confirm/{code}", name="email_confirmation")
     * @param VendorsSecurityRepository $vendorsSecurity
     * @param string $code
     * @return Response
     * @throws Exception
     */
	public function confirmation(VendorsSecurityRepository $vendorsSecurity, string $code): Response
	{

        $vendorsSecurity = $vendorsSecurity->findOneBy(['activationCode' => $code]);

		if ($vendorsSecurity === null) {
			return new Response('404');
		}
        //$vendor = new Vendors();
		//$vendor->setActive(true);
        $vendorsSecurity->setActivationCode('');

		$em = $this->getDoctrine()->getManager();
        //$em->persist($vendor);
		$em->flush();

		return $this->render('security/confirmed.html.twig', [
			'vendor' => $vendorsSecurity,
		]);
	}

    /**
     * @Route("/signin", defaults={"layout" : "signin"}, name="signin", options={"layout" : "signinFormHomePage"},
     *     methods={"GET", "POST"})
     * @Route("/login", defaults={"layout" : "login"}, name="login", options={"layout" : "loginFormHomePage"},
     *     methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Security $security
     * @param AuthenticationUtils $authenticationUtils
     * @param                     $layout
     *
     * @return Response
     */
	public function login(Request $request, Security $security, AuthenticationUtils $authenticationUtils, $layout): Response
	{
	    /*
	     * аутентификация
	     * https://symfonycasts.com/screencast/symfony-security/login-form-authenticator
	     * https://symfonycasts.com/screencast/symfony-security/csrf-token
	     * аутентификация с токеном
	     */
		if ($security->isGranted('ROLE_USER')) {
			return $this->redirectToRoute('homepage');
		}

		$this->saveTargetPath($request->getSession(), 'main', $this->generateUrl('homepage'));

        $loginForm = $this->get('form.factory')->createNamed('', VendorsLoginType::class, array(
            '_username' => $authenticationUtils->getLastUsername()), array(
            'action' => $this->router->generate('login')));

		return $this->render(
			'security/' . $layout . '.html.twig', array(
				'last_username' => $authenticationUtils->getLastUsername(),
				'form'          => $loginForm->createView(),
				'error'         => $authenticationUtils->getLastAuthenticationError()
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
     * @Route("/change", methods={"GET", "POST"}, name="change_security")
     * @param Request $request
     * @param ConfirmationCodeGenerator $codeGenerator
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return Response
     * @throws Exception
     */
	public function change(Request $request,
						   ConfirmationCodeGenerator $codeGenerator,
						   EventDispatcherInterface $eventDispatcher): Response
	{
		/**
		 * TODO:
		 * логика маршрута изменения параметров безопастности практически
		 * идентична маршруту регистрации.
		 * Необходимо коды этих маршрутов вынести в один метод...
		 */
		$recaptcha = new ReCaptcha($this->getParameter('recaptcha_secret'));
		$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());


		$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();

		$vendorCurrent = $this->getUser();

		$form = $this->createForm(SecurityChangePasswordType::class);
		$form->handleRequest($request);

		if (!$resp->isSuccess()) {
			foreach ($resp->getErrorCodes() as $errorCode) {
				$this->addFlash('danger', 'Error captcha: ' . $errorCode);
			}
		} else {

			$formData = $form->getData();
			//dd($formData);
			$password = $this->passwordEncoder->encodePassword(
				$vendorSecurity,
				$formData->getVendorSecurity()->getPlainPassword()
			);
			//$vendor->setEmail();  Хочу добавить в область безопастности смену Емаил

			$vendorSecurity->setActivationCode($codeGenerator->getConfirmationCode());

			$em = $this->getDoctrine()->getManager();
			$em->persist($vendorSecurity);
			$em->persist($vendor);

			$em->flush();

			$vendorRegisteredEvent = new RegisteredEvent($vendor);
			$eventDispatcher->dispatch($vendorRegisteredEvent);

			$this->addFlash('success', 'Success');


			$this->getDoctrine()->getManager()->flush();
			return $this->redirectToRoute('change_security');
		}

		return $this->render(
			'security/change.html.twig', array(
				'form' => $form->createView(),
			)
		);
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

	/**
	 * @Route("/smscodegenerator", name="smscodegenerator")
	 * @param $request
	 *
	 * @return JsonResponse
	 */
	public function smsCodeGenerator(Request $request): Response
	{
		$phone = $request->get('phone');

		$rand = rand(1000, 9999);

		$code = new SmsCodeSendStorage();
		$code->setPhone($phone);
		$code->setCode($rand);

		$em = $this->getDoctrine()
				   ->getManager()
		;
		$em->persist($code);
		$em->flush();

		// Эта строка отправляет смс. Чтобы отправка заработала, необходимо зарегистрироваться на сайте и указать параметры
		//file_get_contents('<a href="https://smsc.ru" class="ext" target="_blank">https://smsc.ru<span
		// class="ext"><span class="element-invisible"> (link is external)</span></span></a>');

		return new JsonResponse(
			[
				'success' => 1,
				'error'   => 0,
				'code'    => $rand,
			]
		);
	}

	public function isSmsCodeConsist(array $formData): array
	{
		// Достаём код из БД по известному нам мобильному номеру
		$codeFromDataBase = $this->getDoctrine()
								 ->getManager()
								 ->getRepository(SmsCodeSendStorage::class)
								 ->findOneBy(
									 [
										 'phone'   => $formData['phone'],
										 'code'    => $formData['code'],
										 'isLogin' => null,
									 ]
								 )
		;

		// Если такого кода в базе нет, возвращаем ошибку
		if (empty($codeFromDataBase)) {
			$data['error'] = 'Неверно введён SMS-код';

			return $data;
		}

		// Проверка, не просрочен ли код
		$createCodeTime = $codeFromDataBase->getCreatedOn();
		$checkTime = (new DateTime())->modify('-5 minutes'); // время действия кода - 5 минут

		if ($checkTime > $createCodeTime) {
			$data['error'] = 'Данный SMS-код уже недействителен. Запросите новый код.';

			return $data;
		}

		// Если же ошибок не обнаружено
		$codeFromDataBase->setIsLogin(1);

		$em = $this->getDoctrine()
				   ->getManager()
		;
		$em->persist($codeFromDataBase);
		$em->flush();

		$data['success'] = 'Пользователь идентифицирован';

		return $data;
	}
}