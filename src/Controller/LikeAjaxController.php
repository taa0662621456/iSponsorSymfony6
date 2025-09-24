<?php

namespace App\Controller;

use App\Entity\Product\ProductFavourite;
use DateTime;
use Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function is_object;

#[AsController]
#[Route(path: '/like')]
class LikeAjaxController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route(path: '/project', name: 'project_like', methods: ['POST'])]
    public function like(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $productRepository = $em->getRepository(\App\Entity\Product\Product::class);
        $favouritesRepository = $em->getRepository(ProductFavourite::class);

        $productId = $request->request->getInt('product_id');
        $product = $productRepository->find($productId);
        $user = $this->getUser();

        if (!$product) {
            return $this->returnErrorJson('productnotfound');
        }

        if (!$user) {
            return $this->returnErrorJson('mustberegistered');
        }

        $favoriteRecord = $favouritesRepository->findOneBy([
            'user' => $user,
            'product' => $product,
        ]);

        $liked = false;
        if (!$favoriteRecord) {
            $favoriteRecord = new ProductFavourite();
            $favoriteRecord->setUser($user);
            $favoriteRecord->setProduct($product);
            $favoriteRecord->setDate(new DateTime());
            $em->persist($favoriteRecord);
            $liked = true;
        } else {
            $em->remove($favoriteRecord);
        }

        $em->flush();

        return new JsonResponse([
            'favourite' => $liked,
            'success' => true,
        ]);
    }

    #[Route(path: '/project_is_liked', name: 'project_is_liked', methods: ['POST'])]
    public function checkIsLiked(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $favouritesRepository = $em->getRepository(ProductFavourite::class);
        $user = $this->getUser();

        if (!$user) {
            return $this->returnErrorJson('mustberegistered');
        }

        $productId = $request->request->getInt('product_id');
        $liked = (bool) $favouritesRepository->findOneBy([
            'user' => $user,
            'product' => $productId,
        ]);

        return new JsonResponse([
            'liked' => $liked,
            'success' => true,
        ]);
    }

    #[Route(path: '/ajax_get_last_seen_projects', name: 'ajax_get_last_seen_projects', methods: ['POST'])]
    public function getLastSeenProductsAction(Request $request): JsonResponse
    {
        $em = $this->managerRegistry->getManager();
        $projectsRepository = $em->getRepository(\App\Entity\Project\Project::class);

        // вместо $this->get('...') надо через DI
        $productIdsArray = $this->pageUtilities->getLastSeenProducts($request);

        $projects = $projectsRepository->getLastSeen(4, $productIdsArray, $this->getUser());

        if (!$projects) {
            return $this->returnErrorJson('productnotfound');
        }

        $html = $this->renderView('lastSeenProducts.html.twig', ['projects' => $projects]);

        return new JsonResponse([
            'html' => $html,
            'success' => true,
        ]);
    }

    private function returnErrorJson(string $message): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'message' => $message,
        ], 400);
    }
}
