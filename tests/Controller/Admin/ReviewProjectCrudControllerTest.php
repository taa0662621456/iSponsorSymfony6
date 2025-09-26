<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\ProjectReview;

class ReviewProjectCrudControllerTest extends WebTestCase
{
    public function testApproveRejectProjectReview(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $rev = new ProjectReview(); $rev->setContent('Good project');
        $em->persist($rev); $em->flush();

        $client->request('GET', '/admin?crudAction=approveReview&entityFqcn=App\\Entity\\ProjectReview&entityId='.$rev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=rejectReview&entityFqcn=App\\Entity\\ProjectReview&entityId='.$rev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
