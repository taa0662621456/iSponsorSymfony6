<?php


namespace App\Tests\Api\Admin;



use SyliusInterface $product */
        $product = $fixtures['product_mug'];
        $this->client->request('GET',
            sprintf('/api/v2/admin/products/%s', $product->getCode()),
            [],
            [],
            $header
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/get_product_response',
            Response::HTTP_OK
        );
    }
}
