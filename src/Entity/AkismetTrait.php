<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

trait AkismetTrait
{
    //TODO: скорее всего эти свойства перенести в ReviewTrait

    #[ORM\Column(name: 'state', type: 'string', options: ['default' => 'submitted', 'comment' => 'Submitted, Spam and Published stats'])]
    private string $state;

    #[Pure] public function __toString(): string
    {
        return $this->getState();
    }


    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }


}
