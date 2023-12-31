<?php

namespace App\Tests\Repository;

use Doctrine\ORM\EntityManager;

trait ObjectRepositoryTestTrait
{
    public static function getClass(): string
    {
        return __CLASS__;
    }

    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName(): void
    {
        $object = $this->getCalled();
        $object = new $object();
        $project = $this->entityManager
            ->getRepository($object)
            ->findOneBy(['id' => 1]);

        $this->assertSame(1, $project->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
