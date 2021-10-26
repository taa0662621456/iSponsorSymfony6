<?php
/**
 * https://symfony.com/doc/current/controller/error_pages.html
 */


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Error404Controller extends AbstractController
{
    /**
     * @Route("/404", name="404")
     * @return Response

     */
    public function pageNotFoundAction(): Response
    {
        return $this->render('_404.html.twig', [
            'currentUri' => '404'
        ]);
    }

}
