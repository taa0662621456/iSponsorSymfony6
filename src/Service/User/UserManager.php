<?php

namespace App\Service\User;

use App\Entity\Vendor;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    public function __construct(
        private readonly CanonicalizerService $canonicalizer,
        private readonly EntityManagerInterface $em
    ) {}

    public function createUser(string $email, ?string $username = null): User
    {
        $user = new Vendor();
        $user->setEmail($this->canonicalizer->canonicalize($email));

        if (!$username) {
            $username = explode('@', $email)[0] . rand(100, 999);
        }

        $user->setUsername($this->canonicalizer->canonicalize($username));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
