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
     * @param $logger
     * @return Response
     */
    public function exception($exception, $logger = null): Response
    {
        return $this->render('_' . $exception->getCode() . '.html.twig', [
            'exception' => $exception->getCode(),
            'message' => $exception->getMessage()
        ]);
    }

}
