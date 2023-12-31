<?php

namespace App\Tests\Api\Utils;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

trait ShopUserLoginTrait
{
    protected function logInShopUser(string $email): string
    {
        /** @var UserRepositoryInterface $shopUserRepository */
        $shopUserRepository = $this->get('repository.shop_user');
        /** @var JWTTokenManagerInterface $manager */
        $manager = $this->get('lexik_jwt_authentication.jwt_manager');

        /** @var ShopUserInterface|null $shopUser */
        $shopUser = $shopUserRepository->findOneByEmail($email);

        return $manager->create($shopUser);
    }
}
