<?php

namespace App\Tests\Api\Shop;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class ProductAttributesTest extends ApiTestCase
{
    private const DEFAULT_HEADERS = [
        'CONTENT_TYPE' => 'application/json',
        'ACCEPT' => 'application/json',
    ];

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testItReturnsProductAttributeFromDefaultLocaleTable(): void
    {
        // Загружаем фикстуры с таблицей product_attributes_en
        $this->loadFixtures(['product_attribute_en.yaml']);

        $response = ProductAttributesTest::createClient()->request('GET', '/api/v1/product-attributes/dishwasher_safe', [
            'headers' => self::DEFAULT_HEADERS,
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $data = $response->toArray();
        // Проверяем, что вернулась локаль EN
        $this->assertSame('Dishwasher safe', $data['name']);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testItReturnsProductAttributeFromSpecificLocaleTable(): void
    {
        // Загружаем фикстуры с таблицей product_attributes_pl
        $this->loadFixtures(['product_attribute_pl.yaml']);

        $response = ProductAttributesTest::createClient()->request('GET', '/api/v1/product-attributes/dishwasher_safe', [
            'headers' => array_merge(self::DEFAULT_HEADERS, [
                'Accept-Language' => 'pl_PL',
            ]),
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $data = $response->toArray();
        // Проверяем, что вернулась локаль PL
        $this->assertSame('Można myć w zmywarce', $data['name']);
    }

    private function loadFixtures(array $fixtures): void
    {
        // Заглушка — сюда подключается твой загрузчик фикстур
        // Например, DoctrineFixturesBundle или кастомный YAML-лоадер
        foreach ($fixtures as $fixture) {
            // loadFixture($fixture);
        }
    }
}
