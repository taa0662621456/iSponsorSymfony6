<?php
namespace App\Controller;

use App\Entity\Vendor\VendorCodeStorage;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorSecurity;
use App\Event\RegisteredEvent;
use App\Form\SecurityChangePasswordType;
use App\Form\Vendor\VendorLoginType;
use App\Form\Vendor\VendorRegistrationType;
use App\Repository\Vendor\VendorSecurityRepository;
use App\Service\ConfirmationCodeGenerator;
use App\Service\EmailVerifier;
use DateTime;
use Exception;

use Psr\Log\LoggerInterface;
use ReCaptcha\ReCaptcha;
use RuntimeException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Uid\Uuid;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
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
    private UserPasswordHasherInterface $passwordHasher;
    /**
     * @var FormFactory
     */
    private FormFactory $formFactory;
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;
    /**
     * @var EmailVerifier $emailVerifier
     */
    private EmailVerifier $emailVerifier;
    private LoggerInterface $logger;

    public function __construct(
        Environment                 $twig,
        UserPasswordHasherInterface $passwordHasher,
        FormFactoryInterface        $formFactory,
        RouterInterface             $router,
        EmailVerifier               $emailVerifier,
        LoggerInterface             $logger,
	)
	{
		$this->logger = $logger;
		$this->twig = $twig;
		$this->passwordHasher = $passwordHasher;
		$this->formFactory = $formFactory;
		$this->router = $router;
        $this->emailVerifier = $emailVerifier;
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
								 EventDispatcherInterface $eventDispatcher,
                                 $layout): Response
	{
        $recaptcha = new ReCaptcha($this->getParameter('app_google_recaptcha_key'));
        //$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorEnGb = new VendorEnGb();

        $form = $this->createForm(VendorRegistrationType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*
                        if (!$resp->isSuccess()) {
                            foreach ($resp->getErrorCodes() as $errorCode) {
                                $this->addFlash('danger', 'Error captcha: ' . $errorCode);
                            }
                        } else {
            */


            try {
                $formData = $form->getData();

                $password = $this->passwordHasher->hashPassword(
                        $vendorSecurity,
                        $formData->getVendorSecurity()->getPlainPassword());
                #
                $slug = Uuid::v4();
                $confirmationCode = $codeGenerator->getConfirmationCode();
                #
                $vendorSecurity->setSlug((string)$slug);
                $vendorSecurity->setUsername((string)$slug);
                $vendorSecurity->setEmail((string)$formData->getVendorSecurity()->getEmail());
                $vendorSecurity->setPhone((string)$formData->getVendorSecurity()->getPhone());
                $vendorSecurity->setPassword($password);
                $vendorSecurity->setActivationCode($confirmationCode);
                #
                $vendorEnGb->setSlug((string)$slug);
                $vendorEnGb->setVendorPhone((string)$formData->getVendorSecurity()->getPhone());
                $vendorEnGb->setVendorZip(000000);
                #
                $vendor->setSlug((string)$slug);
                $vendor->setWorkFlow('submitted');
                $vendor->setActivationCode($confirmationCode);
                $vendor->setVendorSecurity($vendorSecurity);
                $vendor->setVendorEnGb($vendorEnGb);
                #
                $em = $this->getDoctrine()->getManager();
                $em->persist($vendorSecurity);
                $em->persist($vendorEnGb);
                $em->persist($vendor);
                $em->flush();
                #
                $this->addFlash('success', 'Вы успешно зарегистрировались');
                $this->logger->notice('Успешная регистрация');
                #
//                $this->emailVerifier->sendEmailConfirmation('email_confirmation', $vendorSecurity,
//                    (new TemplatedEmail())
//                        ->from(new Address(
//                            $this->getParameter('app_notifications_email_sender'),
//                            $this->getParameter('app_sender_name')))
//                        ->to($vendorSecurity->getEmail())
//                        ->subject('Please Confirm your Email')
//                        ->htmlTemplate('registration/confirmation_email.html.twig')
//                );
                #
                $vendorRegisteredEvent = new RegisteredEvent($vendorSecurity);
                $eventDispatcher->dispatch($vendorRegisteredEvent);
                #
                return $this->redirectToRoute($this->getParameter('app_homepage_routename'));

            } catch (Exception $e) {
//                TODO: в зависимости от ENV или Flash или throw
                $this->addFlash('error', 'Что-то идет не так');
                throw new \UnexpectedValueException(
                    'Что-то пошло не так "%s".'
                );
            }

                /*return $guardHandler->authenticateUserAndHandleSuccess(
                $vendorSecurity,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml);*/
//                return $this->redirectToRoute(...);
//			}
		}
		return $this->render('security/' . $layout . '.html.twig', [
			'form' => $form->createView(),
		]);

	}

    #[Route('/confirmation/email', name: 'email_confirmation')]
    public function verifyUserEmail(Request $request, VendorSecurityRepository $vendorSecurityRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('registration');
        }

        $vendor = $vendorSecurityRepository->find($id);

        if (null === $vendor) {
            return $this->redirectToRoute('registration');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $vendor);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('registration');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('registration');
    }





    /**
     * @Route("/confirmation/{code}", name="code_confirmation")
     * @param VendorSecurityRepository $vendorSecurityRepository
     * @param string $code
     * @return Response
     * @throws Exception
     */
	public function confirmation(VendorSecurityRepository $vendorSecurityRepository, string $code): Response
	{

        $vendorSecurityRepository = $vendorSecurityRepository->findOneBy(['activationCode' => $code]);

		if ($vendorSecurityRepository === null) {
			return new Response('404');
		}

        $vendor = new Vendor();

        $vendor->setIsActive(true);
        #
        $vendorSecurityRepository->setActivationCode('');
        #
		$em = $this->getDoctrine()->getManager();
        $em->persist($vendor);
		$em->flush();

		return $this->render('security/confirmed.html.twig', [
			'vendor' => $vendorSecurityRepository,
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
     * @param string $layout
     *
     * @return Response
     */
	public function login(Request $request, Security $security, AuthenticationUtils $authenticationUtils, string $layout = 'login'): Response
    {

/*        if ($security->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->redirectToRoute('home');
        }*/

//        $this->saveTargetPath($request->getSession(), 'main', $this->generateUrl('homepage'));

        $loginType = $this->get('form.factory')->createNamed('', VendorLoginType::class, [
            '_username' => $authenticationUtils->getLastUsername()], [
            'action' => $this->router->generate('login')]);

        return $this->render(
            'security/' . $layout . '.html.twig', [
				'last_username' => $authenticationUtils->getLastUsername(),
				'form'          => $loginType->createView(),
				'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
		);
	}

	/**
	 * @Route("/logout", name="logout")
	 */
	public function logout(): void
	{
		throw new RuntimeException('This should never be reached!');
//		throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall!');
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
		$recaptcha = new ReCaptcha($this->getParameter('app_google_recaptcha_secret'));
		$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());


		$vendor = new Vendor();
		$vendorSecurity = new VendorSecurity();

		$vendorCurrent = $this->getUser();

		$form = $this->createForm(SecurityChangePasswordType::class);
		$form->handleRequest($request);

		if (!$resp->isSuccess()) {
			foreach ($resp->getErrorCodes() as $errorCode) {
				$this->addFlash('danger', 'Error captcha: ' . $errorCode);
			}
		} else {

			$formData = $form->getData();
			$password = $this->passwordHasher->hashPassword(
				$vendorSecurity,
				$formData->getVendorSecurity()->getPlainPassword()
			);
			//$vendor->setEmail();  Хочу добавить в область безопасности смену Емаил

			$vendorSecurity->setActivationCode($codeGenerator->getConfirmationCode());

			$em = $this->getDoctrine()->getManager();
			$em->persist($vendorSecurity);
			$em->persist($vendor);

			$em->flush();

			$vendorRegisteredEvent = new RegisteredEvent($vendorSecurity);
			$eventDispatcher->dispatch($vendorRegisteredEvent);

			$this->addFlash('success', 'Success. Успешно изменили параметры безопасности');


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
				'username' => $user->getUserIdentifier(),
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

		$code = new VendorCodeStorage();
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
								 ->getRepository(VendorCodeStorage::class)
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
