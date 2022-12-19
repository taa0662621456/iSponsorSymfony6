<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use SyliusLabs\AssociationHydrator\AssociationHydrator;

class AttributeRepository extends EntityRepository
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
        $attributes = parent::findAll();

        $this->associationHydrator->hydrateAssociation($attributes, 'translations');

        return $attributes;
    }
}
