<?php
namespace App\Controller\Security;

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
use App\Service\GoogleRecaptcha;
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
     * @var EmailVerifier $emailVerifier
     */
    private EmailVerifier $emailVerifier;
    private LoggerInterface $logger;

    public function __construct(
        Environment                 $twig,
        UserPasswordHasherInterface $passwordHasher,
        FormFactoryInterface        $formFactory,
        EmailVerifier               $emailVerifier,
        LoggerInterface             $logger,
	)
	{
		$this->logger = $logger;
		$this->twig = $twig;
		$this->passwordHasher = $passwordHasher;
		$this->formFactory = $formFactory;
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
     * @param GoogleRecaptcha $googleRecaptcha
     * @return Response
     */
	public function registration(Request $request,
								 ConfirmationCodeGenerator $codeGenerator,
								 EventDispatcherInterface $eventDispatcher,
                                 $layout, GoogleRecaptcha $googleRecaptcha): Response
	{
        $recaptcha = new ReCaptcha($this->getParameter('app_google_recaptcha_key'));
        $recaptchaResponse = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorEnGb = new VendorEnGb();

        $form = $this->createForm(VendorRegistrationType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            if (!$googleRecaptcha->recaptchaResponse($request)) {echo 'да'} else {echo 'нет'}
            if (!$recaptchaResponse->isSuccess()) {
                foreach ($recaptchaResponse->getErrorCodes() as $errorCode) {
                    $this->addFlash('danger', 'Error captcha: ' . $errorCode);
                }
            } else {
                try {
                    $formData = $form->getData();
                    #
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
                    $this->emailVerifier->sendEmailConfirmation('email_confirmation', $vendorSecurity,
                        (new TemplatedEmail())
                            ->from(new Address(
                                $this->getParameter('app_notifications_email_sender'),
                                $this->getParameter('app_sender_name')))
                            ->to($vendorSecurity->getEmail())
                            ->subject('Please Confirm your Email')
                            ->htmlTemplate('registration/confirmation_email.html.twig')
                    );
                    #
                    $vendorRegisteredEvent = new RegisteredEvent($vendorSecurity);
                    $eventDispatcher->dispatch($vendorRegisteredEvent);
                    #
                    return $this->redirectToRoute($this->getParameter('app_homepage_routename'));

                } catch (Exception $e) {
                    $this->addFlash('error', 'Что-то идет не так');
                    return $this->render('security/' . $layout . '.html.twig', [
                        'form' => $form->createView(),
                    ]);
                }
            }
        }
		return $this->render('security/' . $layout . '.html.twig', [
			'form' => $form->createView(),
//            'error' => $authenticationUtils->getLastAuthenticationError(),
		]);
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

}
