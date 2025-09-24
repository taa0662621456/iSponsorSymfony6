<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\ProductReview;

class ReviewProductCrudControllerTest extends WebTestCase
{
    public function testApproveRejectProductReview(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $rev = new ProductReview(); $rev->setContent('Nice product');
        $em->persist($rev); $em->flush();

        $client->request('GET', '/admin?crudAction=approveReview&entityFqcn=App\\Entity\\ProductReview&entityId='.$rev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=rejectReview&entityFqcn=App\\Entity\\ProductReview&entityId='.$rev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
