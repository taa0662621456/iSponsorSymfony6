<?php


namespace App\Controller\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorProfile;
use App\Form\Vendor\VendorAddType;
use App\Form\Vendor\VendorEditType;
use App\Repository\Project\ProjectRepository;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/vendor')]
#[Route(path: '/sponsor')]
class VendorController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger
    ) {}

    #[Route('/profile', name: 'profile', methods: ['GET','POST'])]
    public function profile(Request $request): Response
    {
        $vendor = $this->getUser()->getVendor();
        $profile = $vendor->getProfile() ?? (new VendorProfile())->setVendor($vendor);

        // простая форма (можно заменить на свой FormType)
        $form = $this->createFormBuilder($profile)
            ->add('firstName', TextType::class, ['required' => false])
            ->add('lastName', TextType::class, ['required' => false])
            ->add('phone', TelType::class, ['required' => false])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$this->isCsrfTokenValid('vendor_profile', $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('CSRF token invalid');
            }

            if ($form->isValid()) {
                try {
                    $this->em->persist($profile);
                    $this->em->flush();
                    $this->logger->info('Vendor profile updated', ['vendor' => $vendor->getId()]);
                    $this->addFlash('success', 'Профиль обновлён');
                    return $this->redirectToRoute('vendor_profile');
                } catch (\Throwable $e) {
                    $this->logger->error('Profile update failed', ['e' => $e]);
                    $this->addFlash('danger', 'Не удалось сохранить профиль');
                }
            } else {
                $this->addFlash('warning', 'Проверьте поля формы');
            }
        }

        return $this->render('vendor/profile.html.twig', [
            'form' => $form->createView(),
            'csrf_token_id' => 'vendor_profile',
        ]);
    }
	#[Route(path: '/', name: 'vendor', methods: ['GET'])]
	public function vendor(VendorRepository $vendorRepository) : Response
	{
		return $this->render('vendor/vendor/index.html.twig', [
      'vendor' => $vendorRepository->findAll(),
  ]);
	}
	/**
	 * @throws Exception
	 */
	#[Route(path: '/new', name: 'vendor_new', methods: ['GET', 'POST'])]
	public function new(Request $request, EntityManager $entityManager) : Response
	{
		$slug = new Slugify();
		$vendor = new Vendor();
		$vendorEnGb = new VendorEnUS();
		// костыль, чтобы вывести пустую форму коллекции
		$vendorMediaAttachment = new VendorMedia();
		$vendorMediaAttachment->setFileClass('');
		$vendor->getVendorMedia()->add($vendorMediaAttachment);
		// костыль, чтобы вывести пустую форму коллекции
		$vendorDocAttachment = new VendorDocument();
		$vendorDocAttachment->setFileClass('');
		$vendor->getVendorDocument()->add($vendorDocAttachment);
		$form = $this->createForm(VendorAddType::class, $vendor);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$s = $form->getData()->vendorEnGb->getSlug();

			if (!isset($s)) {
				$vendor->setSlug($slug->slugify($vendorEnGb->getVendorFirstName()));
			}

			$entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('vendor');
        }
		return $this->render('vendor/vendor/new.html.twig', [
      'vendor' => $vendor,
      'form' => $form->createView(),
  ]);
	}
	#[Route(path: '/{id<\d+>}', name: 'vendor_show', methods: ['GET'])]
	public function show(Vendor $vendor) : Response
	{
		return $this->render('vendor/vendor/show.html.twig', [
      'vendor' => $vendor,
  ]);
	}

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route(path: '/{id<\d+>}/edit', name: 'vendor_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, Vendor $vendor, EntityManager $entityManager) : Response
	{
		$form = $this->createForm(VendorEditType::class, $vendor);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

      return $this->redirectToRoute('vendor');
  }
		return $this->render('vendor/vendor/edit.html.twig', [
      'vendor' => $vendor,
      'form' => $form->createView(),
  ]);
	}

    /**
     * @param ProjectRepository $projects
     * @param $user
     * @return Response
     */
	#[Route(path: '/{id<\d+>}/projects', name: 'vendor_projects', methods: ['GET', 'POST'])]
	public function projects(ProjectRepository $projects, $user) : Response
	{
		return $this->render('vendor/vendor/index.html.twig', [
      'projects' => $projects->findBy(
          ['user' => $user]
      )
        ]);
	}

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route(path: '/{id<\d+>}', name: 'vendor_delete', methods: ['DELETE'])]
	public function delete(Request $request, Vendor $vendor, EntityManager $entityManager) : Response
	{
		if ($this->isCsrfTokenValid('delete'.$vendor->getId(), $request->request->get('_token'))) {
      $entityManager->remove($vendor);
      $entityManager->flush();
  }
		return $this->redirectToRoute('vendor');
	}
}
