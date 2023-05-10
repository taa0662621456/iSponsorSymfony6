<?php

namespace App\Factory\Vendor;


use App\Service\Object\ObjectFactory;

class VendorFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
