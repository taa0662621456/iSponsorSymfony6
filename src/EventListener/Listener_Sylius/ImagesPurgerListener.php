<?php

namespace App\EventListener\Listener_Sylius;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Http\Firewall\AbstractListener;

class ImagesPurgerListener extends AbstractListener implements BeforeSuiteListenerInterface
{
    public function __construct(private readonly Filesystem $filesystem, private readonly string $imagesDirectoryPath)
    {
    }

    public function beforeSuite(SuiteEvent $suiteEvent, array $options): void
    {
        $this->filesystem->remove($this->imagesDirectoryPath);
        $this->filesystem->mkdir($this->imagesDirectoryPath);
        $this->filesystem->touch($this->imagesDirectoryPath.'/.gitkeep');
    }

    public function getName(): string
    {
        return 'images_purger';
    }

    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
        return true;
    }

    public function authenticate(RequestEvent $event)
    {
        // TODO: Implement authenticate() method.
    }
}
