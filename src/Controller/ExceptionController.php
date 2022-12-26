<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ExceptionController extends AbstractController
{
    /**
     * @param $exception
     * @param null $logger
     * @return Response
     */
    #[Route(path: '/exception', name: 'exception')]
    public function exception($exception, $logger = null) : Response
    {
        return $this->render('_' . $exception->getCode() . '.html.twig', [
            'exception' => $exception->getCode(),
            'message' => $exception->getMessage()
        ]);
    }

}
