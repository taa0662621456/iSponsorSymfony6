<?php

namespace App\EntityInterface\Taxation;

interface TaxationRateInterface
{


    public function setIncludedInPrice(mixed $included_in_price);

    public function setCalculator(mixed $calculator);

    public function setZone(mixed $zone);

    public function setCategory(mixed $category);
}
