<?php

namespace App\Controller\Order;

use App\Interface\ProductVariantInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductVariantController extends AbstractController
{
    /**
     * @throws HttpException
     *
     * @psalm-suppress DeprecatedMethod
     */
    public function updatePositionsAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        $productVariantsToUpdate = $this->getParameterFromRequest($request);

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid('update-product-variant-position', (string) $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && null !== $productVariantsToUpdate) {
            foreach ($productVariantsToUpdate as $productVariantToUpdate) {
                if (!is_numeric($productVariantToUpdate['position'])) {
                    throw new HttpException(
                        Response::HTTP_NOT_ACCEPTABLE,
                        sprintf('The product variant position "%s" is invalid.', $productVariantToUpdate['position']),
                    );
                }

                /** @var ProductVariantInterface $productVariant */
                $productVariant = $this->repository->findOneBy(['id' => $productVariantToUpdate['id']]);
                $productVariant->setPosition((int) $productVariantToUpdate['position']);
                $this->manager->flush();
            }
        }

        return new JsonResponse();
    }

    /**
     * @return mixed
     *
     * @deprecated This function will be removed in Sylius 2.0, since Symfony 5.4, use explicit input sources instead
     * based on Symfony\Component\HttpFoundation\Request::get
     */
    private function getParameterFromRequest(Request $request): mixed
    {
        if ($request !== $result = $request->attributes->get('productVariants', $request)) {
            return $result;
        }

        if ($request->query->has('productVariants')) {
            return $request->query->all()['productVariants'];
        }

        if ($request->request->has('productVariants')) {
            return $request->request->all()['productVariants'];
        }

        return null;
    }
}
