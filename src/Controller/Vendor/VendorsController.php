<?php
declare(strict_types=1);

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
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vendors")
 * @Route("/sponsors")
 */
class VendorsController extends AbstractController
{
    /**
     * @var AttachmentManager
     */
    private $attachmentManager;

    public function __construct(AttachmentManager $attachmentManager)
    {
        $this->attachmentManager = $attachmentManager;
    }

    /**
     * @Route("/", name="vendors", methods={"GET"})
     * @param VendorRepository $vendorsRepository
     *
     * @return Response
     */
    public function vendors(VendorRepository $vendorsRepository): Response
    {
        return $this->render('vendor/vendors/index.html.twig', [
            'vendors' => $vendorsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vendors_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function new(Request $request): Response
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

			$entityManager = $this->getDoctrine()->getManager();

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

    /**
	 * @Route("/{id<\d+>}", name="vendors_show", methods={"GET"})
	 * @param Vendor $vendor
	 *
	 * @return Response
	 */
    public function show(Vendor $vendor): Response
    {
        return $this->render('vendor/vendors/show.html.twig', [
            'vendors' => $vendor,
        ]);
	}

	/**
	 * @Route("/{id<\d+>}/edit", name="vendors_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Vendor $vendor
	 * @return Response
	 */
    public function edit(Request $request, Vendor $vendor): Response
    {
        $form = $this->createForm(VendorEditType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vendors');
        }

        return $this->render('vendor/vendors/edit.html.twig', [
            'vendor' => $vendor,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id<\d+>}/projects", name="vendor_projects", methods={"GET","POST"})
     * @param ProjectRepository $projects
     * @param $user
     * @return Response
     */
    public function projects(ProjectRepository $projects, $user): Response
    {
        return $this->render('vendor/vendors/index.html.twig', array(
            'projects' => $projects->findBy(
                array('user' => $user)
            )
        ));
    }


	/**
	 * @Route("/{id<\d+>}", name="vendors_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Vendor $vendor
	 * @return Response
	 */
    public function delete(Request $request, Vendor $vendor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vendor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vendor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vendors');
    }

}
