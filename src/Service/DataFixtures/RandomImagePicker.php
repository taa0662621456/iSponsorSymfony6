<?php

namespace App\Service\DataFixtures;

class RandomImagePicker {

    public function __construct(private readonly ?string $directory = '%app_vendor_profile_avatar%') {
    }

    public function getRandomImage(): array {

        $images = glob($this->directory . '/*.jpg');

        if (empty($images)) {
            return [
                'name' => 'noname.jpg',
                'size' => 0,
                'mime' => 'mime'
                ];
        }

        $randomImage = $images[array_rand($images)];

        return [
            'name' => basename($randomImage),
            'size' => filesize($randomImage),
            'path' => $randomImage,
            'mime' => mime_content_type($randomImage)

        ];
    }
}

