<?php

namespace App\Controller\Product;

use App\Entity\Product\Product;
use App\Interface\Product\ProductTaxationInterface;
use App\Service\Product\ProductTaxationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Attribute\Route;
use Webmozart\Assert\Assert;

#[AsController]
#[Route('/product/taxation', name: 'product_taxation_')]
class ProductTaxationController extends AbstractController
{
    public function __construct(private readonly ProductTaxationService $taxation) {}

    #[Route('/assign/{id}', name: 'assign', methods: ['POST'])]
    public function assign(Product $product, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);
        if (!$this->isCsrfTokenValid('product_tax_'.$product->getId(), $r->request->get('_token'))) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }

        $taxIds = array_map('intval', (array) $r->request->all('taxationIds'));
        $dto = $this->taxation->assignTaxes($product, $taxIds, by: $this->getUser());
        return $this->json($dto);
    }

    private function validateCsrfProtection(Request $request, RequestConfiguration $configuration): void
    {
        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid('update-product-taxon-position', (string) $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }
    }

    private function shouldProductsPositionsBeUpdated(Request $request, ?array $productTaxon): bool
    {
        return in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && null !== $productTaxon;
    }

    private function updatePositions(string $position, int $id): void
    {
        Assert::numeric($position, sprintf('The position "%s" is invalid.', $position));

        /** @var ProductTaxationInterface $productTaxonFromBase */
        $productTaxonFromBase = $this->repository->findOneBy(['id' => $id]);
        $productTaxonFromBase->setPosition((int) $position);
    }

}