<?php
declare(strict_types=1);

namespace App\Controller\Vendor;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsDocumentAttachments;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsMediaAttachments;
use App\Form\Vendor\VendorsAddType;
use App\Form\Vendor\VendorsEditType;
use App\Repository\Project\ProjectsRepository;
use App\Repository\Vendor\VendorsEnGbRepository;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vendors")
 */
class VendorsController extends AbstractController
{
    /**
     * @Route("/", name="vendors", methods={"GET"})
     * @param VendorsEnGbRepository $vendors
     * @return Response
     */
    public function index(VendorsEnGbRepository $vendors): Response
    {
        return $this->render('vendor/vendors/index.html.twig', [
            'vendors' => $vendors->findAll(),
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
		$vendor = new Vendors();
		$vendorEnGb = new VendorsEnGb();
		// костыль, чтобы вывести пустую форму коллекции
		$vendorMediaAttachment = new VendorsMediaAttachments();
		$vendorMediaAttachment->setFileClass('');
		$vendor->getVendorMediaAttachments()->add($vendorMediaAttachment);
		// костыль, чтобы вывести пустую форму коллекции
		$vendorDocAttachment = new VendorsDocumentAttachments();
		$vendorDocAttachment->setFileClass('');
		$vendor->getVendorDocumentAttachments()->add($vendorDocAttachment);

		$form = $this->createForm(VendorsAddType::class, $vendor);
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
     * @Route("/{id}", name="vendors_show", methods={"GET"})
     * @param Vendors $vendor
     * @return Response
     */
    public function show(Vendors $vendor): Response
    {
        return $this->render('vendor/vendors/show.html.twig', [
            'vendors' => $vendor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vendors_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Vendors $vendor
     * @return Response
     */
    public function edit(Request $request, Vendors $vendor): Response
    {
        $form = $this->createForm(VendorsEditType::class, $vendor);
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
     * @param ProjectsRepository $projects
     * @param $user
     * @return Response
     */
    public function projects(ProjectsRepository $projects, $user): Response
    {
        return $this->render('vendor/vendors/index.html.twig', array(
            'projects' => $projects->findBy(
                array('user' => $user)
            )
        ));
    }


    /**
     * @Route("/{id}", name="vendors_delete", methods={"DELETE"})
     * @param Request $request
     * @param Vendors $vendor
     * @return Response
     */
    public function delete(Request $request, Vendors $vendor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vendor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vendor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vendors');
    }

}
