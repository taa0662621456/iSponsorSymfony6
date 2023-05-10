<?php

namespace App\Interface\Payment;

interface PaymentMethodInterface
{

    public function getGatewayConfig();

    public function setCode(mixed $code);

    public function setEnabled(mixed $enabled);

    public function setCurrentLocale(mixed $localeCode);

    public function setFallbackLocale(mixed $localeCode);

    public function setName(mixed $name);

    public function setDescription(mixed $description);

    public function setInstructions(mixed $instructions);

    public function addChannel(mixed $channel);
}
