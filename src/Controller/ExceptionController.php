<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionController extends AbstractController
{
    /**
     * @Route("/exception", name="exception")
     * @param $exception
     * @return Response
     */
    public function exception($exception): Response
    {
        return $this->render('_' . $exception->getCode() . '.html.twig', [
            'exception' => $exception->getCode(),
            'message' => $exception->getMessage()
        ]);
    }

}
