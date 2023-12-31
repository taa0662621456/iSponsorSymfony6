<?php

namespace Controller;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

final class AdminProductVariantAjaxTest extends SessionAwareAjaxTest
{
    public function testItDeniesAccessToProductVariantsForNotAuthenticatedUser(): void
    {
        $this->client->request('GET', '/admin/ajax/product-variants/search-all');

        $response = $this->client->getResponse();

        $this->assertEquals($response->getStatusCode(), Response::HTTP_FOUND);
    }

    public function testItReturnsOnlySpecifiedPartOfAllProductVariantsForEmptyPhrase(): void
    {
        $this->loadFixturesFromFile('authentication/administrator.yml');
        $this->loadFixturesFromFiles(['resources/product_variants.yml']);

        $this->authenticateAdminUser();

        $this->client->request('GET', '/admin/ajax/product-variants/search-all?phrase=');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'ajax/product_variant/index_response', Response::HTTP_OK);
    }

    public function testItThrowsTypeErrorWhenPhraseIsNotSpecified(): void
    {
        $this->loadFixturesFromFile('authentication/administrator.yml');
        $this->loadFixturesFromFiles(['resources/product_variants.yml']);

        $this->authenticateAdminUser();

        $this->expectException(\TypeError::class);

        $this->client->request('GET', '/admin/ajax/product-variants/search-all');
    }

    public function testItReturnsSpecificProductVariantsForGivenPhrase(): void
    {
        $this->loadFixturesFromFile('authentication/administrator.yml');
        $this->loadFixturesFromFiles(['resources/product_variants.yml']);

        $this->authenticateAdminUser();

        $this->client->request('GET', '/admin/ajax/product-variants/search-all?phrase=LA');

        $response = $this->client->getResponse();

        $productVariants = json_decode($response->getContent());

        $this->assertEquals('LARGE_MUG', $productVariants[0]->code);
    }

    private function authenticateAdminUser(): void
    {
        $adminUserRepository = self::$kernel->getContainer()->get('repository.admin_user');
        $user = $adminUserRepository->findOneByEmail('admin@sylius.com');

        $session = self::$kernel->getContainer()->get('request_stack')->getSession();
        $firewallName = 'admin';
        $firewallContext = 'admin';

        /* @deprecated parameter credential was deprecated in Symfony 5.4, so in Sylius 1.11 too, in Sylius 2.0 providing 4 arguments will be prohibited. */
        if (3 === (new \ReflectionClass(UsernamePasswordToken::class))->getConstructor()->getNumberOfParameters()) {
            $token = new UsernamePasswordToken($user, $firewallName, $user->getRoles());
        } else {
            $token = new UsernamePasswordToken($user, null, $firewallName, $user->getRoles());
        }

        $session->set(sprintf('_security_%s', $firewallContext), serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
