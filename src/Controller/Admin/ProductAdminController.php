<?php

namespace App\Controller\Admin;

use App\Entity\Product\Product;
use App\Service\Admin\AdminCrudFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/api/products', name: 'admin_products_')]
final class ProductAdminController extends AbstractController
{
    public function __construct(private readonly AdminCrudFacade $crud) {}

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[IsGranted('DELETE', subject: 'product')]
    public function delete(Product $product): Response
    {
        return $this->crud->delete(Product::class, $product->getId());
    }
}
