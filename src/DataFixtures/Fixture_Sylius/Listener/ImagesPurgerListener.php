<?php

namespace App\DataFixtures\Fixture_Sylius\Listener;

classImagesPurgerListener extends AbstractListener implements BeforeSuiteListenerInterface
{
    public function __construct(private Filesystem $filesystem, private string $imagesDirectoryPath)
    {
    }

    public function beforeSuite(SuiteEvent $suiteEvent, array $options): void
    {
        $this->filesystem->remove($this->imagesDirectoryPath);
        $this->filesystem->mkdir($this->imagesDirectoryPath);
        $this->filesystem->touch($this->imagesDirectoryPath . '/.gitkeep');
    }

    public function getName(): string
    {
        return 'images_purger';
    }
}
