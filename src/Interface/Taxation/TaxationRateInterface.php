<?php

namespace App\Interface\Taxation;

interface TaxationRateInterface
{

    public function setCode(mixed $code);

    public function setName(mixed $name);

    public function setAmount(mixed $amount);

    public function setIncludedInPrice(mixed $included_in_price);

    public function setCalculator(mixed $calculator);

    public function setZone(mixed $zone);

    public function setCategory(mixed $category);
}
