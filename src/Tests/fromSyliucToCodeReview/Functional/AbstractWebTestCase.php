<?php


namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class AbstractWebTestCase extends BaseWebTestCase
{
    public static function setUpBeforeClass(): void
    {
        static::deleteTmpDir();
    }

    public static function tearDownAfterClass(): void
    {
        static::deleteTmpDir();
    }

    protected static function deleteTmpDir()
    {
        if (!file_exists($dir = sys_get_temp_dir() . '/SyliusInterface
    {
        $class = self::getKernelClass();

        return new $class(
            $options['environment'] ?? $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'test',
            (bool) ($options['debug'] ?? $_ENV['APP_DEBUG'] ?? $_SERVER['APP_DEBUG'] ?? false),
            $options['test_case'] ?? null,
        );
    }

    protected static function getKernelClass(): string
    {
        return 'Sylius\Tests\Functional\app\AppKernel';
    }
}
