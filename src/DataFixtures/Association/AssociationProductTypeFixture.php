<?php

namespace App\DataFixtures\Association;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\AbstractDataFixture;
use App\Repository\Association\AssociationProductTypeRepository;
use App\Entity\Association\AssociationProductType;

final class AssociationProductTypeFixture extends AbstractDataFixture
{
    protected readonly ObjectManager $objectManager;

    private AssociationProductTypeRepository $associationProductTypeRepository;

    public function __construct(AssociationProductTypeRepository $associationProductTypeRepository)
    {
        parent::__construct();
        $this->associationProductTypeRepository = $associationProductTypeRepository;
    }

    public function getName(): string
    {
        return 'product_association_type';
    }

    public function load(ObjectManager $manager): void
    {
        $this->objectManager = $manager;

        $types = $this->getDataFromDatabase(); // Получение данных из базы данных

        foreach ($types as $type) {
            $productAssociationType = new AssociationProductType();
            $productAssociationType->setName($type['name']);
            $productAssociationType->setCode($type['code']);

            $this->objectManager->persist($productAssociationType);
        }

        $this->objectManager->flush();
        $this->objectManager->clear();
    }
}
