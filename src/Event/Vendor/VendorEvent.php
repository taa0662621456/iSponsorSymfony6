<?php

namespace App\Event\Vendor;

use App\Event\VendorEvent as Event;
use Symfony\Component\Security\Core\User\UserInterface;

class VendorEvent extends Event
{
    public function __construct(private readonly UserInterface $user)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
