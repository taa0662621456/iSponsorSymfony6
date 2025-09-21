<?php

namespace App\Tests\Functional\app;

use Symfony\Component\Config\Loader\LoaderInterface;
use App\Kernel;

class AppKernel extends Kernel
{
    public function __construct(
        string $environment,
        bool $debug,
        private readonly ?string $testCase = null
    ) {
        parent::__construct($environment, $debug);
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir() . '/php_app_cache/' . ($this->testCase ?? $this->environment);
    }

    /**
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        parent::registerContainerConfiguration($loader);

        if (null !== $this->testCase) {
            $loader->load(__DIR__ . sprintf('/%s/config.yml', $this->testCase));
        }
    }
}
