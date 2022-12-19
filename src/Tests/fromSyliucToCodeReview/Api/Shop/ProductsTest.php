<?php


namespace App\Tests\Api\Shop;


use SyliusInterface $product */
        $product = $fixtures['product_mug'];
        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/products/%s', $product->getCode()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_with_default_locale_translation',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_returns_product_with_translations_in_locale_from_header(): void
    {
        $fixtures = $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        /** @var ProductInterface $product */
        $product = $fixtures['product_mug'];
        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/products/%s', $product->getCode()),
            [],
            [],
            ['CONTENT_TYPE' => 'application/ld+json', 'HTTP_ACCEPT' => 'application/ld+json', 'HTTP_ACCEPT_LANGUAGE' => 'de_DE']
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_with_de_DE_locale_translation',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_returns_products_collection(): void
    {
        $this->loadFixturesFromFiles(['product/product_variant_with_original_price.yaml']);

        $this->client->request(
            'GET',
            '/api/v2/shop/products',
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_products_collection_response',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_returns_product_attributes_collection_with_translations_in_locale_from_header(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product/product_attribute.yaml']);

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/products/%s/attributes', 'MUG_SW'),
            [],
            [],
            array_merge(self::CONTENT_TYPE_HEADER, ['HTTP_ACCEPT_LANGUAGE' => 'pl_PL'])
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_attributes_collection_response'
        );
    }

    /** @test */
    public function it_returns_paginated_attributes_collection(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'product/product_attribute.yaml']);

        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/products/%s/attributes', 'MUG_SW'),
            ['itemsPerPage' => 2],
            [],
            array_merge(self::CONTENT_TYPE_HEADER, ['HTTP_ACCEPT_LANGUAGE' => 'pl_PL'])
        );

        $this->assertCount(2, json_decode($this->client->getResponse()->getContent(), true)['hydra:member']);
    }
}
