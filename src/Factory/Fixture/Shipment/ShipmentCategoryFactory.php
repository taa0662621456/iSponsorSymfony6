<?php


namespace App\Factory\Fixture\Shipment;


use App\Service\Fixture\FixtureFactory;

final class ShipmentCategoryFactory extends FixtureFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
