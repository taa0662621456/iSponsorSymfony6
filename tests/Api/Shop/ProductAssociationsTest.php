<?php


namespace Shop;


use SyliusInterface $association */
        $association = $fixtures['product_association'];
        $this->client->request('GET',
            sprintf('/api/v2/shop/product-associations/%s', $association->getId()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'shop/product/get_product_association_response',
            Response::HTTP_OK
        );
    }

    /** @test */
    public function it_returns_nothing_if_association_not_found(): void
    {
        $this->loadFixturesFromFile('product/product_with_many_locales.yaml');

        $this->client->request('GET',
            sprintf('/api/v2/shop/product-associations/%s', 'wrong input'),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
