<?php

namespace App\DTO\Vendor;


final class VendorMessageDTO
{

    private mixed $messageMineDTO;

    public function getMessageMine(): mixed
    {
        return $this->messageMine;
    }

    public function setMessageMine($messageMine): void
    {
        $this->messageMine = $messageMine;
    }

}
