<?php

namespace App\Service\Storage;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class StorageFilter implements FilterStorageInterface
{
    public function __construct(private readonly SessionInterface|RequestStack $requestStackOrSession)
    {
        if ($this->requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/admin-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    public function set(array $filters): void
    {
        $this->getSession()->set('filters', $filters);
    }

    public function all(): array
    {
        return $this->getSession()->get('filters', []);
    }

    public function hasFilters(): bool
    {
        return [] !== $this->getSession()->get('filters', []);
    }

    private function getSession(): SessionInterface
    {
        if ($this->requestStackOrSession instanceof RequestStack) {
            return $this->requestStackOrSession->getSession();
        }

        return $this->requestStackOrSession;
    }
}