<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Sylius\Bundle\ProductBundle\Doctrine\ORM\ProductOptionRepository as BaseProductOptionRepository;
use SyliusLabs\AssociationHydrator\AssociationHydrator;

class ProductOptionRepository extends BaseProductOptionRepository
{
    /** @var AssociationHydrator */
    protected $associationHydrator;

    public function __construct(EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);

        $this->associationHydrator = new AssociationHydrator($entityManager, $class);
    }

    public function findAll(): array
    {
        $productOptions = parent::findAll();

        $this->associationHydrator->hydrateAssociation($productOptions, 'translations');

        return $productOptions;
    }
}
