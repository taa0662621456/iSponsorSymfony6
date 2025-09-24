<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class VendorDocumentAttachmentFixtures extends DataFixtures
{
    /**
     * @param ObjectManager $manager
     * @param array|null $property
     */
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(),
            'lastTitle' => fn($faker, $i) => $faker->realText(7000),
        ];

        try {
            parent::load($manager, $property);
        } catch (ClientExceptionInterface|TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface $e) {
        }
    }
}