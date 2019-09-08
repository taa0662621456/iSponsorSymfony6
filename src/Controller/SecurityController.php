<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Vendor\Vendors;
use App\Event\RegisteredEvent;
use App\Form\SecurityChangePasswordType;
use App\Form\Vendor\VendorSignUpType;
use App\Repository\VendorsRepository;
use App\Service\ConfirmationCodeGenerator;
use Exception;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig_Environment;


class SecurityController extends AbstractController
{
    use TargetPathTrait;

    /**
     * @var Twig_Environment $twig
     */
    private $twig;

    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    /**
     * @Route("/registration", name="registration")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Request $request
     * @param ConfirmationCodeGenerator $codeGenerator
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     * @throws Exception
     */
    public function registration(UserPasswordEncoderInterface $passwordEncoder, Request $request, ConfirmationCodeGenerator $codeGenerator, EventDispatcherInterface $eventDispatcher): Response
    {
        $vendor = new Vendors();
        $form = $this->createForm(VendorSignUpType::class, $vendor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vendor = $form->getData();

            $password = $passwordEncoder->encodePassword(
                $vendor,
                $vendor->getPlainPassword()
            );

            $vendor->setEmail($vendor->getEmail());
            $vendor->setPassword($password);
            $vendor->setActivationCode($codeGenerator->getConfirmationCode());


            $em = $this->getDoctrine()->getManager();

            $em->persist($vendor);
            $em->flush();

        }
        $vendorRegisteredEvent = new RegisteredEvent($vendor);
        $eventDispatcher->dispatch($vendorRegisteredEvent);

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
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

        $vendor->setIsActive(true);
        $vendor->setActivationCode('');

        $em = $this->getDoctrine()->getManager();

        $em->flush();

        return $this->render('security/confirmed.html.twig', [
            'vendor' => $vendor,
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @param Security $security
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function login(AuthenticationUtils $authenticationUtils, Security $security, Request $request): Response
    {
        // if user is already logged in, don't display the login page again
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('projects');
        }

        // this statement solves an edge-case: if you change the locale in the login
        // page, after a successful login you are redirected to a page in the previous
        // locale. This code regenerates the referrer URL whenever the login page is
        // browsed, to ensure that its locale is always the current one.
        $this->saveTargetPath($request->getSession(), 'main', $this->generateUrl('projects'));

        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();

        return new Response($this->twig->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' =>  $error
        ])
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



}