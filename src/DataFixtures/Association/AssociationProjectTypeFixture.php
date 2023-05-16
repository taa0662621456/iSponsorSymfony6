<?php

namespace App\DataFixtures\Association;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\AbstractDataFixture;
use App\Repository\Association\AssociationProjectTypeRepository;
use App\Entity\Association\AssociationProjectType;

final class AssociationProjectTypeFixture extends AbstractDataFixture
{
    protected readonly ObjectManager $objectManager;

    private AssociationProjectTypeRepository $associationProjectTypeRepository;

    public function __construct(AssociationProjectTypeRepository $associationProductTypeRepository)
    {
        parent::__construct();
        $this->associationProjectTypeRepository = $associationProductTypeRepository;
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
            $productAssociationType = new AssociationProjectType();
            $productAssociationType->setName($type['name']);
            $productAssociationType->setCode($type['code']);

            $this->objectManager->persist($productAssociationType);
        }

        $this->objectManager->flush();
        $this->objectManager->clear();
    }
}
