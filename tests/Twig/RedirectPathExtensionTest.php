<?php

namespace Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class RedirectPathExtensionTest extends KernelTestCase
{
    private RedirectPathExtension $redirectPathExtension;

    protected function setUp(): void
    {
        $container = self::getContainer();

        $session = $container->get('session.factory')->createSession();
        $request = new Request();
        $request->setSession($session);
        $container->get('request_stack')->push($request);

        //        $this->redirectPathExtension = $container->get('Sylius\Bundle\UiBundle\Twig\RedirectPathExtension');
        //        $container->get('Sylius\Bundle\UiBundle\Storage\FilterStorage')->set(['criteria' => ['enabled' => true]]);
    }

    public function testItReturnsRedirectPathWithFiltersFromStorageApplied(): void
    {
        $redirectPath = $this->redirectPathExtension->generateRedirectPath('/admin/shipping-categories/');

        $this->assertSame('/admin/shipping-categories/?criteria%5Benabled%5D=1', $redirectPath);
    }

    public function testItReturnsGivenPathIfRouteHasSomeMoreConfiguration(): void
    {
        $redirectPath = $this->redirectPathExtension->generateRedirectPath('/admin/ajax/products/search');

        $this->assertSame('/admin/ajax/products/search', $redirectPath);
    }

    public function testItReturnsGivenPathIfRouteAlreadyHasQueryParameters(): void
    {
        $redirectPath = $this->redirectPathExtension->generateRedirectPath('/admin/shipping-categories/?foo=bar');

        $this->assertSame('/admin/shipping-categories/?foo=bar', $redirectPath);
    }

    public function testItReturnsGivenPathIfRouteIsNotMatched(): void
    {
        $redirectPath = $this->redirectPathExtension->generateRedirectPath('/admin/invalid-path');

        $this->assertSame('/admin/invalid-path', $redirectPath);
    }

    public function testItReturnsNullIfThePathIsNullAsWell(): void
    {
        $redirectPath = $this->redirectPathExtension->generateRedirectPath(null);

        $this->assertNull($redirectPath);
    }
}
