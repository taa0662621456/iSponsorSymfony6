<?php
declare(strict_types=1);

namespace App\Tool;

use Symfony\Component\Form\DataTransformerInterface;

class FileTransformer implements DataTransformerInterface
{
    public function transform($file): array
    {
        return [
            'file' => $file,
        ];
    }
    public function reverseTransform($data)
    {
        return $data['file'];
    }
}