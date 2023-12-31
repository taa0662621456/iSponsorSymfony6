<?php

namespace App\Controller;


use App\Service\GptExceptionConsulter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class GptConsulterController extends AbstractController
{
    #[Route(path: 'prompt', name: 'prompt', methods: ['GET', 'POST'])]
    public function prompt(GptExceptionConsulter $gptExceptionConsulter): string
    {
        $result = $gptExceptionConsulter->generateComment('sdsd', 'sdsd');

        return $this->json(['generated_text' => $result]);
    }

}
