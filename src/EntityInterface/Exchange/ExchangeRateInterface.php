<?php

namespace App\EntityInterface\Exchange;

interface ExchangeRateInterface
{
    public function getSourceCurrency();

    public function getRatio();

    public function getTargetCurrency();
}