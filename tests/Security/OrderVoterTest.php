<?php

use App\Security\Voter\OrderVoter;
use App\Entity\Order\Order;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

function makeUser(array $roles): User {
    $user = new User();
    $user->setRoles($roles);
    return $user;
}

function makeOrder(?User $customer = null): Order {
    $order = new Order();
    if (method_exists($order, 'setCustomer')) {
        $order->setCustomer($customer);
    }
    return $order;
}

it('allows ROLE_ADMIN everything', function () {
    $voter = new OrderVoter();
    $user = makeUser(['ROLE_ADMIN']);
    $order = makeOrder();
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    foreach ([OrderVoter::VIEW, OrderVoter::EDIT, OrderVoter::DELETE] as $attr) {
        expect($voter->vote($token, $order, [$attr]))->toBe(OrderVoter::ACCESS_GRANTED);
    }
});

it('allows ROLE_MANAGER to view and edit but not delete', function () {
    $voter = new OrderVoter();
    $user = makeUser(['ROLE_MANAGER']);
    $order = makeOrder();
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    expect($voter->vote($token, $order, [OrderVoter::VIEW]))->toBe(OrderVoter::ACCESS_GRANTED)
        ->and($voter->vote($token, $order, [OrderVoter::EDIT]))->toBe(OrderVoter::ACCESS_GRANTED)
        ->and($voter->vote($token, $order, [OrderVoter::DELETE]))->toBe(OrderVoter::ACCESS_DENIED);
});

it('allows ROLE_CUSTOMER to view own order only', function () {
    $voter = new OrderVoter();
    $user = makeUser(['ROLE_CUSTOMER']);
    $ownOrder = makeOrder($user);
    $otherOrder = makeOrder(makeUser(['ROLE_CUSTOMER']));
    $token = new UsernamePasswordToken($user, 'credentials', 'memory', $user->getRoles());
    expect($voter->vote($token, $ownOrder, [OrderVoter::VIEW]))->toBe(OrderVoter::ACCESS_GRANTED)
        ->and($voter->vote($token, $otherOrder, [OrderVoter::VIEW]))->toBe(OrderVoter::ACCESS_DENIED);
});
