<?php

/*
 * This file is part of the SyliusInterface;
use SyliusInterface $customer */
        $customer = $fixtures['customer_oliver'];

        $authorizationHeader = $this->getAuthorizationHeaderAsCustomer($customer->getEmailCanonical(), 'isponsor');

        $this->client->request(
            'POST',
            '/api/v2/shop/contact-requests',
            [],
            [],
            array_merge($authorizationHeader, self::CONTENT_TYPE_HEADER),
            json_encode([
                'email' => 'customer@email.com',
                'message' => 'Example of message'
            ])
        );

        $response = $this->client->getResponse();

        $this->assertResponseCode($response, Response::HTTP_ACCEPTED);
        self::assertEmailCount(1);
        self::assertEmailAddressContains(self::getMailerMessage(), 'To', 'web@sylius.com');
    }
}
