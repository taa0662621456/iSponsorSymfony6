<?php

namespace Functional;

use PHPUnit\Framework\Assert;
use Symfony\Component\BrowserKit\Client;
use Sylius\Component\Core\Model\ProductImage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class ImageUploaderTest extends WebTestCase
{
    /** @var Client */
    private static $client;

    public function testItSanitizesFileContentIfItIsSvgMimeType(): void
    {
        self::$client = static::createClient();

        $imageUploader = self::$kernel->getContainer()->get('image_uploader');
        $fileSystem = self::$kernel->getContainer()->get('gaufrette.sylius_image_filesystem');

        $file = new UploadedFile(__DIR__.'/../Resources/xss.svg', 'xss.svg');
        Assert::assertStringContainsString('<script', $this->getContent($file));

        $image = new ProductImage();
        $image->setFile($file);

        $imageUploader->upload($image);

        $sanitizedFile = $fileSystem->get($image->getPath());
        Assert::assertStringNotContainsString('<script', $sanitizedFile->getContent());
    }

    private function getContent(UploadedFile $file): string
    {
        $content = file_get_contents($file->getPathname());

        if (false === $content) {
            throw new FileException(sprintf('Could not get the content of the file "%s".', $file->getPathname()));
        }

        return $content;
    }
}
