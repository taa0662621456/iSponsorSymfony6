<?php

namespace App\Service\Locale;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;

final class LocaleExterminator implements RouterInterface, WarmableInterface
{
    public function __construct(private readonly RouterInterface $router, private readonly LocaleContextInterface $localeContext)
    {
    }

    public function match($path): array
    {
        return $this->router->match($path);
    }

    public function generate($name, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        $url = $this->router->generate($name, $parameters, $referenceType);

        if (!str_contains($url, '_locale')) {
            return $url;
        }

        return $this->removeUnusedQueryArgument($url, $this->localeContext->getLocaleCode());
    }

    public function setContext(RequestContext $context): void
    {
        $this->router->setContext($context);
    }

    public function getContext(): RequestContext
    {
        return $this->router->getContext();
    }

    public function getRouteCollection(): RouteCollection
    {
        return $this->router->getRouteCollection();
    }

    public function warmUp($cacheDir): void
    {
        if ($this->router instanceof WarmableInterface) {
            $this->router->warmUp($cacheDir);
        }
    }

    private function removeUnusedQueryArgument(string $url, string $value): string
    {
        $replace = [
            sprintf('&%s=%s', '_locale', $value) => '',
            sprintf('?%s=%s&', '_locale', $value) => '?',
            sprintf('?%s=%s', '_locale', $value) => '',
        ];

        return str_replace(array_keys($replace), $replace, $url);
    }
}