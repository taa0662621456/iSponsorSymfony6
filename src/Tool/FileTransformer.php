<?php


namespace App\Tool;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\DataTransformerInterface;

class FileTransformer implements DataTransformerInterface
{
    #[ArrayShape(['file' => "mixed"])] public function transform($value): array
    {
        return [
            'file' => $value,
        ];
    }
    public function reverseTransform($data)
    {
        return $data['file'];
    }
}
