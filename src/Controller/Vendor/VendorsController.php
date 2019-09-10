<?php
declare(strict_types=1);

namespace App\Controller\Vendor;

use App\Entity\Vendor\Vendors;
use App\Form\Vendor\VendorsAddType;
use App\Form\Vendor\VendorsType;
use App\Repository\ProjectsRepository;
use App\Repository\VendorsEnGbRepository;
use Exception;
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
        $vendor = new Vendors();
        $form = $this->createForm(VendorsAddType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{id<\d+>}/edit", name="vendors_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Vendors $vendor
     * @return Response
     */
    public function edit(Request $request, Vendors $vendor): Response
    {
        $form = $this->createForm(VendorsType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vendors_index');
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

        return $this->redirectToRoute('vendor/vendors_index');
    }

}
