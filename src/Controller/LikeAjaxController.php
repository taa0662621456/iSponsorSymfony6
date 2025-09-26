<?php

namespace App\Controller;

use App\Entity\Product\ProductFavourite;
use DateTime;
use Exception;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function is_object;

/**
 * Class AjaxController.
 */
#[AsController]
#[Route(path: '/like')]
class LikeAjaxController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __constructor(ManagerRegistry $managerRegistry): void
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/project', name: 'project_like', methods: ['POST'])]
    public function like(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $productRepository = $em->getRepository('ShopBundle:Product');
        $favouritesRepository = $em->getRepository('ShopBundle:Favourites');
        $productId = $request->request->getInt('product_id');
        $product = $productRepository->find($productId);
        $user = $this->getUser();
        if (!is_object($product)) {
            return $this->returnErrorJson('productnotfound');
        } elseif (!is_object($user)) {
            return $this->returnErrorJson('mustberegistered');
        }
        $favoriteRecord = $favouritesRepository->findOneBy([
            'user' => $this->getUser(),
            'product' => $product,
        ]);
        $liked = false;
        if (!is_object($favoriteRecord)) {
            $favoriteRecord = new ProductFavourite(); // add like
            $favoriteRecord->setUser($this->getUser());
            $favoriteRecord->setProduct($product);
            $favoriteRecord->setDate(new DateTime());
            $em->persist($favoriteRecord);
            $liked = true;
        } else {
            $em->remove($favoriteRecord); // remove like
        }
        $em->flush();

        return new JsonResponse([
            'favourite' => $liked,
            'success' => true,
        ], 200);
    }

    #[Route(path: '/project_is_liked', name: 'project_is_liked', methods: ['POST'])]
    public function checkIsLiked(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $favouritesRepository = $em->getRepository('ShopBundle:Favourites');
        $user = $this->getUser();
        if (!$user) {
            return $this->returnErrorJson('mustberegistered');
        }
        $productId = $request->request->getInt('product_id');
        $liked = $favouritesRepository->checkIsLiked($user, $productId);

        return new JsonResponse([
            'liked' => $liked,
            'success' => true,
        ], 200);
    }

    #[Route(path: '/ajax_get_last_seen_projects', name: 'ajax_get_last_seen_projects', methods: ['POST'])]
    public function getLastSeenProductsAction(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $projectsRepository = $em->getRepository('projects');
        $productIdsArray = $this->get('app.page_utilities')->getLastSeenProducts($request);
        $projects = $projectsRepository->getLastSeen(4, $productIdsArray, $this->getUser());
        if (!$projects) {
            $this->returnErrorJson('product not forund');
        }
        $html = $this->renderView('lastSeenProducts.html.twig', ['projects' => $projects]);

        return new JsonResponse([
            'html' => $html,
            'success' => true,
        ], 200);
    }

    private function returnErrorJson(string $message): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'message' => $message,
        ], 400);
    }
}
