<?php
namespace App\ServiceInterface;

use App\Entity\Vendor\VendorSecurity;

/**
 * Общий контракт для всех видов 2FA.
 */
interface TwoFactorServiceInterface
{
    /**
     * Подготовка 2FA (например, отправка SMS или генерация QR).
     */
    public function prepare(VendorSecurity $user): void;

    /**
     * Проверка кода (TOTP, SMS, email).
     */
    public function validate(VendorSecurity $user, string $code): bool;

    /**
     * Уточнение: какой именно метод используется (sms, totp, email).
     */
    public function getMethodName(): string;
}