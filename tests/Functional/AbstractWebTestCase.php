<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Kernel;

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

    protected static function deleteTmpDir(): void
    {
        $fs = new Filesystem();
        $tmpDir = sys_get_temp_dir() . '/app_test_tmp';

        if ($fs->exists($tmpDir)) {
            $fs->remove($tmpDir);
        }
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        $environment = $options['environment'] ?? ($_ENV['APP_ENV'] ?? 'test');
        $debug = (bool) ($options['debug'] ?? ($_ENV['APP_DEBUG'] ?? false));

        $kernel = new Kernel($environment, $debug);

        if (!empty($options['test_case'])) {
            $configPath = __DIR__ . '/config/' . $options['test_case'] . '.yaml';

            if (file_exists($configPath)) {
                $kernel->boot();
                $container = $kernel->getContainer();

                $loader = $container->get('config.loader');
                $loader->load($configPath);
            }
        }

        return $kernel;
    }
}
