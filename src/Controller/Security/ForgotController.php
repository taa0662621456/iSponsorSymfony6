<?php


namespace App\Controller\Security;


use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorSecurity;
use App\Form\Forgot\ForgotType;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[AsController]
class ForgotController extends AbstractController
{

    /**
     * ForgotCredential constructor.
     */
    public function __construct(private readonly LoggerInterface $logger, private readonly ManagerRegistry $managerRegistry)
    {
    }

    /**
     * @throws TransportExceptionInterface|\Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    #[Route(path: '/forgot/email', name: 'forgot_email', methods: ['GET', 'POST'])]
    #[Route(path: '/forgot/phone', name: 'forgot_phone', methods: ['GET', 'POST'])]
    #[Route(path: '/forgot/password', name: 'forgot_password', methods: ['GET', 'POST'])]
    public function forgotCredential(Request $request, AuthenticationUtils $authenticationUtils, MailerInterface $mailer, TexterInterface $texter) : Response
    {
        if (null !== $this->getUser()) {
            $this->addFlash('success', 'Вы уже авторизовались');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }
        if (null !== $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('notice', 'В данный момент Вы авторизованы в системе');
            return $this->redirectToRoute($this->getParameter('app_default_target_path'), [], '200');
        }
        $credential = explode('_', $request->attributes->get('_route'), '2');
        $credential = $credential[1];
        $forgotCredentialType = 'App\Form\Forgot\Forgot' . ucfirst($credential) . 'Type';
        $vendor = new Vendor();
        $form = $this->createForm(ForgotType::class, $vendor, [
            'forgot_сredential_type' => $forgotCredentialType,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($credential == 'password') {

                $user = $this->managerRegistry->getRepository(VendorSecurity::class)->findOneBy(['email' => (string)$form->getData()->getVendorSecurity()->getEmail()]);

                if (null !== $user) {

                    $plainPassword = uniqid('', true);
                    $password = md5($plainPassword);
                    $user->setPassword($password);
                    $this->managerRegistry->getManager()->persist($user);
                    $this->managerRegistry->getManager()->flush();

                    $email = (new Email())
                        ->from(new Address(
                            $this->getParameter('app_notification_email_sender'),
                            $this->getParameter('app_email_sender')
                        ))
                        ->to($user->getEmail())
                        ->subject('iSponsor! Please, use Your new password:')
                        ->text('iSponsor! Please, use Your new password:' . $plainPassword)
                    ;

                    $mailer->send($email);

                    $this->addFlash('success', 'Новый пароль будет отправлен на Ваш email');
                } else {
                    $this->addFlash('success', 'Пользователь с таким email не найден');
                }

            } elseif ($credential == 'email') {

                $user = $this->managerRegistry->getRepository(VendorSecurity::class)->findOneBy(
                    ['phone' => (string)$form->getData()->getVendorSecurity()->getPhone()]
                );

                if (null !== $user) {

                    $sms = new SmsMessage(
                        (string)$form->getData()->getVendorSecurity()->getPhone(),
                        'Привет. Это будет код-восстановления пароля.'
                    );
                    $sentMessage = $texter->send($sms);

                    $this->addFlash('success', 'Вы успешно запросили восстановление учетных данных');
                } else {
                    $this->addFlash('success', 'Пользователь с таким email не найден');
                }


            } elseif ($credential == 'phone') {

                $user = $this->managerRegistry->getRepository(VendorSecurity::class)->findOneBy(['email' => (string)$form->getData()->getVendorSecurity()->getEmail()]);

                if (null !== $user) {

                    $email = (new Email())
                        ->from(new Address(
                            $this->getParameter('app_notification_email_sender'),
                            $this->getParameter('app_email_sender')
                        ))
                        ->to($user->getEmail())
                        ->subject('iSponsor! Please, use Your new password:')
                        ->text('iSponsor! Please, use Your email:' . $user->getEmail())
                    ;

                    $mailer->send($email);

                    $this->addFlash('success', 'На Вашу почту отправлено письмо с кодом подтверждения');
                } else {
                    $this->addFlash('success', 'Пользователь с таким запросом не найден');
                }
            }

            $this->logger->notice('восстановление учетных данных');
        }
        return $this->render(
            'security/forgot.html.twig', [
                'last_username' => $authenticationUtils->getLastUsername(),
                'form'          => $form->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError(),
            ]
        );
    }
}
