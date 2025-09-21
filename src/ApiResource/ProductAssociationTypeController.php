<?php

namespace App\ApiResource;

use App\Entity\Product\ProductAssociationType;
use App\Repository\Product\ProductAssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v2/shop/product-association-types', name: 'api_shop_product_association_types_')]
final class ProductAssociationTypeController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ProductAssociationRepository $repository): Response
    {
        $associationTypes = $repository->findAll();

        $data = array_map(static fn(ProductAssociationType $type) => [
            'id'   => $type->getId(),
            'code' => $type->getCode(),
            'name' => $type->getName(),
        ], $associationTypes);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/{code}', name: 'show', methods: ['GET'])]
    public function show(string $code, ProductAssociationRepository $repository): Response
    {
        $associationType = $repository->findOneBy(['code' => $code]);

        if (!$associationType instanceof ProductAssociationType) {
            return new JsonResponse(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $associationType->getId(),
            'code' => $associationType->getCode(),
            'name' => $associationType->getName(),
        ]);
    }
}
