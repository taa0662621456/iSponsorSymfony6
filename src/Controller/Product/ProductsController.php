<?php
declare(strict_types=1);
namespace App\Controller\Product;

use App\Entity\Product\Products;
use App\Entity\Product\ProductsAttachments;
use App\Entity\Product\ProductsEnGb;
use App\Form\Product\ProductsType;
use App\Repository\Category\CategoriesRepository;
use App\Repository\Product\ProductsRepository;
use App\Service\AttachmentsManager;
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
	 * @var AttachmentsManager
	 */
	private $attachmentManager;

	public function __construct(AttachmentsManager $attachmentManager)
	{
		$this->attachmentManager = $attachmentManager;
	}

	/**
	 * @Route("/", name="products_index", methods={"GET"})
	 * @param CategoriesRepository $categoriesRepository
	 * @param ProductsRepository   $projectsRepository
	 *
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
		$productAttachment = new ProductsAttachments();
		$productAttachment->setFileClass('');
		$product->getProductAttachments()->add($productAttachment);

		$form = $this->createForm(ProductsType::class, $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($product);


			$s = $form->get('productEnGb')->get('slug')->getData();
            if (!isset($s)) {
				//$form->set('productEnGb')->set('slug')->setSlug($slug->slugify($productEnGb->getProductName()))
				$product->setSlug($slug->slugify($productEnGb->getProductName()));
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

}
