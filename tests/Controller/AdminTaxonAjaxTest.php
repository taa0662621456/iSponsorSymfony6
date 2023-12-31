<?php

namespace Controller;

use PHPUnit\Framework\Assert;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

final class AdminTaxonAjaxTest extends SessionAwareAjaxTest
{
    public function testItDeniesAccessToTaxonsForNotAuthenticatedUser(): void
    {
        $this->client->request('GET', '/admin/ajax/taxons/search');

        $response = $this->client->getResponse();

        $this->assertEquals($response->getStatusCode(), Response::HTTP_FOUND);
    }

    public function testItReturnsTaxonsForEmptyPhrase(): void
    {
        $this->loadFixturesFromFile('authentication/administrator.yml');
        $this->loadFixturesFromFiles(['resources/taxons.yml']);

        $this->authenticateAdminUser();

        $this->client->request('GET', '/admin/ajax/taxons/search?phrase=');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'ajax/taxon/index_response', Response::HTTP_OK);
    }

    public function testItReturnsTaxonsWhenPhraseIsNotSpecified(): void
    {
        $this->loadFixturesFromFile('authentication/administrator.yml');
        $this->loadFixturesFromFiles(['resources/taxons.yml']);

        $this->authenticateAdminUser();

        $this->client->request('GET', '/admin/ajax/taxons/search');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'ajax/taxon/index_response', Response::HTTP_OK);
    }

    public function testItReturnsSpecificTaxonsForGivenPhrase(): void
    {
        Assert::assertNotEmpty(
            $this->loadFixturesFromFile('authentication/administrator.yml'),
            'Could not load administrator.yml'
        );
        Assert::assertNotEmpty(
            $this->loadFixturesFromFile('resources/taxons.yml'),
            'Could not load taxons.yml'
        );

        $this->authenticateAdminUser();

        $this->client->request('GET', '/admin/ajax/taxons/search?phrase=Women');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'ajax/taxon/specific_taxon_response', Response::HTTP_OK);
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
