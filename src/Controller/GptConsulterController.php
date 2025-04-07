<?php

namespace App\Controller;


use App\Service\GptExceptionConsulter;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class GptConsulterController extends AbstractController
{
    #[NoReturn] #[Route(path: 'prompt', name: 'prompt', methods: ['GET', 'POST'])]
    public function prompt(GptExceptionConsulter $gptExceptionConsulter): string
    {
        $result = $gptExceptionConsulter->generateComment('sdsd', 'sdsd');

        return $this->json(['generated_text' => $result]);
    }

}
