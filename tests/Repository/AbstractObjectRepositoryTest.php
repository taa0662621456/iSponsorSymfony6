<?php

namespace App\Tests\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AbstractObjectRepositoryTest extends KernelTestCase
{
    // TODO: взять имя класса потомка и на его основе сэтапить тесты
    public static function getCalledClass(): string
    {
        return get_called_class();
    }

    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $object = $this->getCalledClass();
        $object = new $object();
        $project = $this->entityManager
            ->getRepository($object)
            ->findOneBy(['id' => 1])
        ;

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
