<?php
declare(strict_types=1);

namespace App\Controller;

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
use Doctrine\ORM\NonUniqueResultException;
use Exception;
use LogicException;
use ReCaptcha\ReCaptcha;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use Symfony\Component\Security\Http\LoginLink\LoginLinkNotification;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Uid\Uuid;
use Twig\Environment;


class SecurityController extends AbstractController
{
    use TargetPathTrait;

    /**
     * @var Environment $twig
     */
    private Environment $twig;
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $passwordEncoder;
    /**
     * @var FormFactory
     */
    private FormFactory $formFactory;
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    public function __construct(
        Environment                 $twig,
        UserPasswordHasherInterface $passwordHashes,
        FormFactoryInterface        $formFactory,
        RouterInterface             $router
	)
	{
		$this->twig = $twig;
		$this->passwordEncoder = $passwordHashes;
		$this->formFactory = $formFactory;
		$this->router = $router;
	}

    /**
     * @Route("/registration", name="registration", defaults={"layout" : "registration"}, options={"layout" : "registration"}, methods={"GET", "POST"})
     * @Route("/signup", name="signup", defaults={"layout" : "signup"}, options={"layout" : "signup"}, methods={"GET", "POST"})
     * @param Request $request
     * @param ConfirmationCodeGenerator $codeGenerator
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @param $layout
     * @return Response
     * @throws Exception
     */
	public function registration(Request $request,
								 ConfirmationCodeGenerator $codeGenerator,
								 EventDispatcherInterface $eventDispatcher, $layout): Response
	{
		//$recaptcha = new ReCaptcha($this->getParameter('google_recaptcha_site_key'));
		//$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
		$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();
		$vendorEnGb = new VendorsEnGb();

		$form = $this->createForm(VendorsRegistrationType::class, $vendor);
		$form->handleRequest($request);

		if ($form->isSubmitted()) {
/*
			if (!$resp->isSuccess()) {
				foreach ($resp->getErrorCodes() as $errorCode) {
					$this->addFlash('danger', 'Error captcha: ' . $errorCode);
				}
			} else {
*/
				$formData = $form->getData();
				//dd($formData->ve);
				$password = $this->passwordEncoder->hashPassword(
				    $vendorSecurity,
					$formData->getVendorSecurity()->getPlainPassword()
				);



				try {
                    $slug = $uuid = Uuid::v4();
					//$slug = $slug->encode($uuid);

					$vendor->setUuid($uuid);
					$vendor->setSlug((string)$slug);
                    $vendor->setWorkFlow('submitted');

					$vendorSecurity->setUuid($uuid);
					$vendorSecurity->setSlug((string)$slug);

					$vendorSecurity->setEmail((string)$formData->getVendorSecurity()->getEmail());
					$vendorSecurity->setPhone((string)$formData->getVendorSecurity()->getPhone());


					$vendorEnGb->setUuid($uuid);
					$vendorEnGb->setSlug((string)$slug);
					$vendorEnGb->setVendorPhone((string)$formData->getVendorSecurity()->getPhone());

				} catch (Exception $e) {
				}
				$vendor->setVendorSecurity($vendorSecurity);
				$vendor->setWorkFlow('submitted');
				$vendorSecurity->setPassword((string)$password);
				$vendorSecurity->setActivationCode((string)$codeGenerator->getConfirmationCode());
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

		return $this->render('security/' . $layout . '.html.twig', [
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
         * аутентификация токеном
         */

/*        if ($security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->redirectToRoute('home');
        }*/

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
		 * логика маршрута изменения параметров безопасности практически
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
			$password = $this->passwordEncoder->hashPassword(
				$vendorSecurity,
				$formData->getVendorSecurity()->getPlainPassword()
			);
			//$vendor->setEmail();  Хочу добавить в область безопасности смену Емаил

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
     * TODO: for testing any knowledge
	 * @Route("/admin")
	 * @Route("/administrator")
	 */
	public function admin(): Response
    {
		return new Response('<html lang="en"><body>Admin page!</body></html>');
	}

	/**
	 * @Route("/login/json", name="login_json", methods={"POST"})
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function jsonLogin(Request $request): JsonResponse
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
	public function forgot(): Response
    {
		return new Response('<html lang="en"><body>Are You forgot any auth parameters?</body></html>');
	}

    /**
     * @Route("/smscodegenerator", name="smscodegenerator")
     * @param Request $request
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
		$createCodeTime = $codeFromDataBase->getcreatedAt();
		$checkTime = (new DateTime())->modify('-5 minutes'); // время действия кода - 5 минут

		if ($checkTime > $createCodeTime) {
			$data['error'] = 'Данный SMS-код уже недействителен. Запросите новый код.';

			return $data;
		}

		// Если же ошибок не обнаружено
		$codeFromDataBase->setIsLogin((bool)1);

		$em = $this->getDoctrine()
				   ->getManager()
		;
		$em->persist($codeFromDataBase);
		$em->flush();

		$data['success'] = 'Пользователь идентифицирован';

		return $data;
	}
}
