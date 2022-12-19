<?php

namespace App\Interface;

interface CartStorageInterface
{

    public function setForChannel($getChannel, \App\OrderInterface $cart);
}
