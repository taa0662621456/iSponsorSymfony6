<?php
declare(strict_types=1);

namespace App\Controller\Profile;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsIban;
use App\Form\Vendor\VendorsIbanType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/iban")
 */
class ProfileIbanController extends AbstractController
{
    /**
     * @Route("/", name="profile_index", methods={"GET"})
     */
    public function index(): Response
    {
        $vendorIban = $this->getDoctrine()
            ->getRepository(VendorsIban::class)
            ->findOneBy(['id' => $this->getUser()->getId()]);

        return $this->render('vendor/vendors_iban/index.html.twig', [
            'vendor_iban' => $vendorIban,
        ]);
    }

    /**
     * @Route("/new", name="profile_iban_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $vendor = new Vendors;
        $form = $this->createForm(Vendors::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('vendor_vendors_iban_index');
        }

        return $this->render('vendor/vendors_iban/new.html.twig', [
            'vendors_iban' => $vendorsIban,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profile_iban_show", methods={"GET"})
     */
    public function show(VendorsIban $vendorsIban): Response
    {
        return $this->render('vendor/vendors_iban/show.html.twig', [
            'vendors_iban' => $vendorsIban,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profile_iban_edit", methods={"GET","POST"})
     * @param Request $request
     * @param VendorsIban $vendorsIban
     * @return Response
     */
    public function edit(Request $request, VendorsIban $vendorsIban): Response
    {
        $form = $this->createForm(VendorsIbanType::class, $vendorsIban);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vendor_vendors_iban_index');
        }

        return $this->render('vendor/vendors_iban/edit.html.twig', [
            'vendors_iban' => $vendorsIban,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profile_iban_delete", methods={"DELETE"})
     * @param Request $request
     * @param VendorsIban $vendorsIban
     * @return Response
     */
    public function delete(Request $request, VendorsIban $vendorsIban): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vendorsIban->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vendorsIban);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vendor_vendors_iban_index');
    }
}
