<?php
namespace App\Controller\Security;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorSecurity;
use App\Event\RegisteredEvent;
use App\Form\Vendor\VendorRegistrationType;
use App\Service\ConfirmationCodeGenerator;
use App\Service\EmailVerifier;

use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Uid\Uuid;
use Twig\Environment;


class RegistrationController extends AbstractController
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
     * @param EventDispatcherInterface $eventDispatcher
     * @param $layout
     * @return Response
     * @throws \Exception
     */
	public function registration(Request $request,
								 EventDispatcherInterface $eventDispatcher,
                                 $layout): Response
	{
        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorEnGb = new VendorEnGb();

        $form = $this->createForm(VendorRegistrationType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $recaptcha = new ReCaptcha($this->getParameter('app_google_recaptcha_secret'));
//            $recaptchaResponse = $recaptcha->verify($request->request->get('vendor_registration')['captcha']);
//
//            if (!$recaptchaResponse->isSuccess()) {
//                foreach ($recaptchaResponse->getErrorCodes() as $errorCode) {
//                    $this->addFlash('danger', 'Error captcha: ' . $errorCode);
//                    return $this->render('security/' . $layout . '.html.twig', [
//                        'form' => $form->createView(),
//                    ]);
//                }
//            }
                #
                $formData = $form->getData();
//                #
//                $sms = new SmsMessage(
//                    (string)$formData->getVendorSecurity()->getPhone(), 'Привет. Это круть'
//                );
//                $sentMessage = $texter->send($sms);
//                #
                $password = $this->passwordHasher->hashPassword(
                    $vendorSecurity,
                    $formData->getVendorSecurity()->getPlainPassword());
                #
                $vendorSecurity->setEmail((string)$formData->getVendorSecurity()->getEmail());
                $vendorSecurity->setPhone((string)$formData->getVendorSecurity()->getPhone());
                $vendorSecurity->setPassword($password);
                #
                $vendorEnGb->setVendorPhone((string)$formData->getVendorSecurity()->getPhone());
                #
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
                            $this->getParameter('app_email_sender')
                        ))
                        ->to($vendorSecurity->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );
                #
                $this->addFlash('success', 'На Вашу почту отправлено письмо с кодом подтверждения');
                #
                $vendorRegisteredEvent = new RegisteredEvent($vendorSecurity);
                $eventDispatcher->dispatch($vendorRegisteredEvent);
                #
                return $this->redirectToRoute($this->getParameter('app_homepage_route'));
            }
		return $this->render('security/' . $layout . '.html.twig', [
			'form' => $form->createView(),
		]);
	}

}
