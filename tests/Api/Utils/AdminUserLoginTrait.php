<?php

namespace App\Tests\Api\Utils;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

trait AdminUserLoginTrait
{
    protected function logInAdminUser(string $email): string
    {
        /** @var UserRepositoryInterface $adminUserRepository */
        $adminUserRepository = $this->get('repository.admin_user');
        /** @var JWTTokenManagerInterface $manager */
        $manager = $this->get('lexik_jwt_authentication.jwt_manager');

        /** @var ShopUserInterface|null $adminUser */
        $adminUser = $adminUserRepository->findOneByEmail($email);

        return $manager->create($adminUser);
    }
}
