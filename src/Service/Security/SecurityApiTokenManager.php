<?php
namespace App\Service\Security;

use App\Entity\Vendor\SecurityApiToken;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class SecurityApiTokenManager
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    /**
     * @throws \Exception
     */
    public function create(VendorSecurity $user, array $scope = [], array $ips = []): SecurityApiToken
    {
        $token = new SecurityApiToken($user, $scope, $ips);
        $token->setCode(Uuid::v7()->toRfc4122()); // BaseTrait: поле code уникальное
        $this->em->persist($token);
        $this->em->flush();
        return $token;
    }

    public function rotate(SecurityApiToken $token): SecurityApiToken
    {
        $token->setCode(Uuid::v7()->toRfc4122());
        $this->em->flush();
        return $token;
    }
}