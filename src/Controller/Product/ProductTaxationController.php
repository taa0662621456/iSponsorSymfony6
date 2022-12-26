<?php

namespace App\Controller\Product;

use App\Interface\Product\ProductTaxationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Webmozart\Assert\Assert;

#[AsController]
class ProductTaxationController extends AbstractController
{

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
