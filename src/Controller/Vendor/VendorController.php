<?php

namespace App\Controller\Vendor;

use Cocur\Slugify\Slugify;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManager;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorMediaAttachment;
use App\Form\Vendor\VendorAddType;
use App\Form\Vendor\VendorEditType;
use App\Entity\Vendor\VendorDocumentAttachment;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use App\Repository\Vendor\VendorRepository;
use App\Repository\Project\ProjectRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
#[Route(path: '/vendor')]
#[Route(path: '/sponsor')]
class VendorController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/', name: 'vendor', methods: ['GET'])]
    public function vendor(VendorRepository $vendorRepository): Response
    {
        return $this->render('vendor/vendor/index.html.twig', [
      'vendor' => $vendorRepository->findAll(),
  ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/new', name: 'vendor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManager $entityManager): Response
    {
        $slug = new Slugify();
        $vendor = new Vendor();
        $vendorEnGb = new VendorEnUS();
        // костыль, чтобы вывести пустую форму коллекции
        $vendorMediaAttachment = new VendorMediaAttachment();
        $vendorMediaAttachment->setFileClass('');
        $vendor->getVendorMedia()->add($vendorMediaAttachment);
        // костыль, чтобы вывести пустую форму коллекции
        $vendorDocAttachment = new VendorDocumentAttachment();
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
    public function show(Vendor $vendor): Response
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
    public function edit(Request $request, Vendor $vendor, EntityManager $entityManager): Response
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

    #[Route(path: '/{id<\d+>}/projects', name: 'vendor_projects', methods: ['GET', 'POST'])]
    public function projects(ProjectRepository $projects, $user): Response
    {
        return $this->render('vendor/vendor/index.html.twig', [
      'projects' => $projects->findBy(
          ['user' => $user]
      ),
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route(path: '/{id<\d+>}', name: 'vendor_delete', methods: ['DELETE'])]
    public function delete(Request $request, Vendor $vendor, EntityManager $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vendor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vendor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vendor');
    }
}
