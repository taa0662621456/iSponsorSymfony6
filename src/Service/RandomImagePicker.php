<?php

namespace App\Service;

class RandomImagePicker
{
    private string $imageDir;

    public function __construct(string $imageDir = '/path/to/your/images')
    {
        $this->imageDir = $imageDir;
    }

    public function getRandomImage(): ?array
    {
        if (!is_dir($this->imageDir)) {
            return null;
        }

        $files = array_values(array_filter(scandir($this->imageDir), function ($file) {
            return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
        }));

        if (empty($files)) {
            return null;
        }

        $randomFile = $files[array_rand($files)];
        $filePath = $this->imageDir . DIRECTORY_SEPARATOR . $randomFile;

        return [
            'name' => $randomFile,
            'size' => filesize($filePath),
            'path' => $filePath,
        ];
    }

}
