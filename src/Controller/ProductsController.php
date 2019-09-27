<?php
declare(strict_types=1);
namespace App\Controller;

use App\Entity\Product\Products;
use App\Entity\Product\ProductsAttachments;
use App\Entity\Product\ProductsEnGb;
use App\Form\Product\ProductsType;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use App\Service\AttachmentManager;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/products")
 */
class ProductsController extends AbstractController
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
     * @Route("/", name="products_index", methods={"GET"})
     * @param CategoriesRepository $categoriesRepository
     * @param ProductsRepository $projectsRepository
     * @return Response
     */
    public function index(CategoriesRepository $categoriesRepository, ProductsRepository $projectsRepository): Response
    {
        return $this->render('product/products/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
            'products' => $projectsRepository->findAll() // должна быть ленивая порционная загрузка
        ]);
    }

    /**
     * @Route("/new", name="products_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function new(Request $request): Response
    {
        $slug = new Slugify();
        $product = new Products();
        $productEnGb = new ProductsEnGb();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);


            $s = $form->get('productEnGb')->get('slug')->getData();
            if (!isset($s))
            {
                //$form->set('productEnGb')->set('slug')->setSlug($slug->slugify($productEnGb->getProductName()))
				$product->setProductSlug($slug->slugify($productEnGb->getProductName()));
            }
            $entityManager->flush();


            return $this->redirectToRoute('products_index');
        }

        return $this->render('product/products/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_show", methods={"GET"})
     * @param Products $product
     * @return Response
     */
    public function show(Products $product): Response
    {
        return $this->render('product/products/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="products_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Products $product
     * @return Response
     */
    public function edit(Request $request, Products $product): Response
    {
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('products_index');
        }

        return $this->render('product/products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/attachment/{id}", name="attachment")
     * @param Request $request
     * @param Products $projects
     * @param ProductsAttachments $projectsAttachments
     * @return Response
     */
    public function attachment(Request $request, Products $projects, ProductsAttachments $projectsAttachments)
    {
        $file = $request->get('file');

        $filenameAndPath = $this->attachmentManager->uploadAttachment($file, $projects, $projectsAttachments);

        return $this->json([
            'location' => $filenameAndPath['path']
        ]);
    }

    /**
     * @Route("/{id}", name="products_delete", methods={"DELETE"})
     * @param Request $request
     * @param Products $product
     * @return Response
     */
    public function delete(Request $request, Products $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products_index');
    }
}
