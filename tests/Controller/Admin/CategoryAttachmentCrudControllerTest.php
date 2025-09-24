<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Category;
use App\Entity\CategoryAttachment;

class CategoryAttachmentCrudControllerTest extends WebTestCase
{
    public function testAddRemoveAttachment(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $cat = new Category(); $cat->setTitle('Cat B');
        $em->persist($cat); $em->flush();

        $att = new CategoryAttachment();
        $att->setCategory($cat)->setFile('cat.pdf');
        $em->persist($att); $em->flush();

        $client->request('GET', '/admin?crudAction=removeAttachment&entityFqcn=App\\Entity\\CategoryAttachment&entityId='.$att->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
