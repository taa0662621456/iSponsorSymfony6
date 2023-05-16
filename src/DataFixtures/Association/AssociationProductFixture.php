<?php


namespace App\DataFixtures\Association;

use App\DataFixtures\AbstractDataFixture;
use App\Entity\Association\AssociationProduct;
use App\Repository\Association\AssociationProductTypeRepository;
use App\Repository\Product\ProductRepository;


final class AssociationProductFixture extends AbstractDataFixture
{
    private ProductRepository $productRepository;
    private AssociationProductTypeRepository $associationTypeProductRepository;

    public function __construct(
        ProductRepository $productRepository,
        AssociationProductTypeRepository $associationTypeProductRepository
    ) {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->associationTypeProductRepository = $associationTypeProductRepository;
    }

    public function getName(): string
    {
        return 'association_product';
    }

    public function load($manager): void
    {
        parent::load($manager);

        // Получаем все продукты
        $products = $this->productRepository->findAll();

        // Получаем все типы ассоциаций
        $associationTypes = $this->associationTypeProductRepository->findAll();

        // Создаем ассоциации продуктов
        foreach ($products as $product) {
            foreach ($associationTypes as $associationType) {
                // Создаем новую ассоциацию продукта
                $associationProduct = new AssociationProduct();
                $associationProduct->setProduct($product);
                $associationProduct->setAssociationType($associationType);

                // Сохраняем ассоциацию продукта
                $manager->persist($associationProduct);
            }
        }

        // Сохраняем изменения в базе данных
        $manager->flush();
        $manager->clear();
    }
}
