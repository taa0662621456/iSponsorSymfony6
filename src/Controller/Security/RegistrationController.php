<?php
namespace App\Controller\Security;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorSecurity;
use App\Form\Vendor\VendorSecurityType;
use App\Service\EmailConfirmation;

use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
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
     * @var EmailConfirmation $emailVerifier
     */
    private EmailConfirmation $emailConfirmation;
    private LoggerInterface $logger;

    public function __construct(
        Environment                 $twig,
        UserPasswordHasherInterface $passwordHasher,
        FormFactoryInterface        $formFactory,
        EmailConfirmation           $emailConfirmation,
        LoggerInterface             $logger,
	)
	{
		$this->logger = $logger;
		$this->twig = $twig;
		$this->passwordHasher = $passwordHasher;
		$this->formFactory = $formFactory;
        $this->emailConfirmation = $emailConfirmation;
	}

    /**
     * @Route("/registration", name="registration", defaults={"layout" : "registration"}, options={"layout" : "registration"}, methods={"GET", "POST"})
     * @Route("/signup", name="signup", defaults={"layout" : "signup"}, options={"layout" : "signup"}, methods={"GET", "POST"})
     * @param Request $request
     * @param \Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator $recaptcha3Validator
     * @param \Symfony\Component\Notifier\TexterInterface $texter
     * @param string $layout
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Symfony\Component\Notifier\Exception\TransportExceptionInterface
     */
	public function registration(Request $request,
                                 Recaptcha3Validator $recaptcha3Validator,
                                 TexterInterface $texter,
                                 string $layout = 'registration'): Response
	{
        if (null !== $this->getUser()) {
            $this->addFlash('success', 'Вы уже авторизовались');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('success', 'Вы уже авторизовались');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }

        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorEnGb = new VendorEnGb();

        $form = $this->createForm(VendorSecurityType::class, $vendor);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();
            #
            if ($recaptcha3Validator->getLastResponse()->getScore() * 100 - 1 <= $this->getParameter('env(RECAPTCHA_SCOPE)') * 100) {
                $sms = new SmsMessage(
                    (string)$formData->getVendorSecurity()->getPhone(), 'Привет. Это будет код-верификации.'
                );
                $sentMessage = $texter->send($sms);
            }
            #
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
            $this->emailConfirmation->confirmationSignatureSender('confirmation_email', $vendorSecurity,
                (new TemplatedEmail())
                    ->from(new Address(
                        $this->getParameter('app_notification_email_sender'),
                        $this->getParameter('app_email_sender')
                    ))
                    ->to($vendorSecurity->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('success', 'На Вашу почту отправлено письмо с кодом подтверждения');

            return $this->redirectToRoute($this->getParameter('app_homepage_route'));
        }

        return $this->render('security/' . $layout . '.html.twig', [
			'form' => $form->createView(),
            'error' => null
		]);
	}
}
