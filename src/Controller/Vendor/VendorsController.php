<?php


namespace App\Controller\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorMedia;
use App\Form\Vendor\VendorAddType;
use App\Form\Vendor\VendorEditType;
use App\Repository\Project\ProjectRepository;
use App\Repository\Vendor\VendorRepository;
use App\Service\AttachmentManager;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/vendors')]
#[Route(path: '/sponsors')]
class VendorsController extends AbstractController
{
	public function __construct()
	{
	}
	#[Route(path: '/', name: 'vendors', methods: ['GET'])]
	public function vendors(VendorRepository $vendorsRepository) : Response
	{
		return $this->render('vendor/vendors/index.html.twig', [
      'vendors' => $vendorsRepository->findAll(),
  ]);
	}
	/**
	 * @throws Exception
	 */
	#[Route(path: '/new', name: 'vendors_new', methods: ['GET', 'POST'])]
	public function new(Request $request, EntityManager $entityManager) : Response
	{
		$slug = new Slugify();
		$vendor = new Vendor();
		$vendorEnGb = new VendorEnGb();
		// костыль, чтобы вывести пустую форму коллекции
		$vendorMediaAttachment = new VendorMedia();
		$vendorMediaAttachment->setFileClass('');
		$vendor->getVendorMediaAttachments()->add($vendorMediaAttachment);
		// костыль, чтобы вывести пустую форму коллекции
		$vendorDocAttachment = new VendorDocument();
		$vendorDocAttachment->setFileClass('');
		$vendor->getVendorDocumentAttachments()->add($vendorDocAttachment);
		$form = $this->createForm(VendorAddType::class, $vendor);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			$s = $form->getData()->vendorEnGb->getSlug();

			if (!isset($s)) {
				$vendor->setSlug($slug->slugify($vendorEnGb->getVendorFirstName()));
			}

			$entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('vendors');
        }
		return $this->render('vendor/vendors/new.html.twig', [
      'vendor' => $vendor,
      'form' => $form->createView(),
  ]);
	}
	#[Route(path: '/{id<\d+>}', name: 'vendors_show', methods: ['GET'])]
	public function show(Vendor $vendor) : Response
	{
		return $this->render('vendor/vendors/show.html.twig', [
      'vendors' => $vendor,
  ]);
	}

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    #[Route(path: '/{id<\d+>}/edit', name: 'vendors_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, Vendor $vendor, EntityManager $entityManager) : Response
	{
		$form = $this->createForm(VendorEditType::class, $vendor);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

      return $this->redirectToRoute('vendors');
  }
		return $this->render('vendor/vendors/edit.html.twig', [
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
		return $this->render('vendor/vendors/index.html.twig', array(
      'projects' => $projects->findBy(
          array('user' => $user)
      )
  ));
	}

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    #[Route(path: '/{id<\d+>}', name: 'vendors_delete', methods: ['DELETE'])]
	public function delete(Request $request, Vendor $vendor, EntityManager $entityManager) : Response
	{
		if ($this->isCsrfTokenValid('delete'.$vendor->getId(), $request->request->get('_token'))) {
      $entityManager->remove($vendor);
      $entityManager->flush();
  }
		return $this->redirectToRoute('vendors');
	}
}
