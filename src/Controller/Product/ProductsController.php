<?php
declare(strict_types=1);
namespace App\Controller\Product;

use App\Entity\Product\Product;
use App\Entity\Product\ProductAttachment;
use App\Entity\Product\ProductEnGb;
use App\Form\Product\ProductsType;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Service\AttachmentsManager;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
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
	private AttachmentsManager $attachmentManager;

	public function __construct(AttachmentsManager $attachmentManager)
	{
		$this->attachmentManager = $attachmentManager;
	}

	/**
	 * @Route("/", name="products_index", methods={"GET"})
	 * @param CategoryRepository $categoriesRepository
	 * @param ProductRepository   $projectsRepository
	 *
	 * @return Response
	 */
	public function index(CategoryRepository $categoriesRepository, ProductRepository $projectsRepository): Response
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
		$product = new Product();
		$productEnGb = new ProductEnGb();
		$productAttachment = new ProductAttachment();
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
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        return $this->render('product/products/show.html.twig', [
            'product' => $product,
        ]);
    }


    /**
     * @Route("/attachment/{id}", name="attachment")
     * @param Request $request
     * @param Product $projects
     * @param ProductAttachment $projectsAttachments
     * @return Response
     */
    public function attachment(Request $request, Product $projects, ProductAttachment $projectsAttachments): Response
    {
        $file = $request->get('file');

        $filenameAndPath = $this->attachmentManager->uploadAttachment($file, $projects, $projectsAttachments);

        return $this->json([
            'location' => $filenameAndPath['path']
        ]);
    }

}
