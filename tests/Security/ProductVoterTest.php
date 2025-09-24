<?php

use App\Security\Voter\ProductVoter;
use App\Entity\Product\Product;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

function makeProduct(): Product {
    return new Product();
}

it('allows ROLE_ADMIN full access', function () {
    $voter = new ProductVoter();
    $user = new User();
    $user->setRoles(['ROLE_ADMIN']);
    $product = makeProduct();
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    foreach ([ProductVoter::VIEW, ProductVoter::EDIT] as $attr) {
        expect($voter->vote($token, $product, [$attr]))->toBe(ProductVoter::ACCESS_GRANTED);
    }
});

it('allows ROLE_MANAGER to view but not edit', function () {
    $voter = new ProductVoter();
    $user = new User();
    $user->setRoles(['ROLE_MANAGER']);
    $product = makeProduct();
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    expect($voter->vote($token, $product, [ProductVoter::VIEW]))->toBe(ProductVoter::ACCESS_GRANTED)
        ->and($voter->vote($token, $product, [ProductVoter::EDIT]))->toBe(ProductVoter::ACCESS_DENIED);
});

it('denies ROLE_CUSTOMER any access', function () {
    $voter = new ProductVoter();
    $user = new User();
    $user->setRoles(['ROLE_CUSTOMER']);
    $product = makeProduct();
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    foreach ([ProductVoter::VIEW, ProductVoter::EDIT] as $attr) {
        expect($voter->vote($token, $product, [$attr]))->toBe(ProductVoter::ACCESS_DENIED);
    }
});
