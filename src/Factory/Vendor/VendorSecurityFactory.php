<?php

namespace App\Factory\Vendor;

use App\Service\Object\ObjectFactory;

class VendorSecurityFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
