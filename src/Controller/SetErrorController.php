<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class SetErrorController extends AbstractController
{
    public function setError($message, int $status = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $response = new JsonResponse(['error' => $message]);

        return $response->setStatusCode($status);
    }
}
