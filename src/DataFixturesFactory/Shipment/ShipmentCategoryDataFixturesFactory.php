<?php


namespace App\DataFixturesFactory\Shipment;


use App\DataFixturesFactoryInterface\Shipment\ShipmentCategoryDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class ShipmentCategoryDataFixturesFactory extends DataFixturesFactory implements ShipmentCategoryDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

}
