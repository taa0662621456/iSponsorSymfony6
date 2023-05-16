<?php

namespace App\DTO;

trait AkismetDTOTrait
{
    // TODO: скорее всего эти свойства перенести в ReviewDTOTrait

    private string $stateDTO;


    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }
}
