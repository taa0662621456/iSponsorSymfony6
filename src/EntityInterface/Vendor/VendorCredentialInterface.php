<?php

namespace App\EntityInterface\Vendor;

interface VendorCredentialInterface
{
    public function getPlainPassword(): ?string;

    public function setPlainPassword(?string $plainPassword): void;

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     */
    public function getPassword(): string|null;

    public function setPassword(?string $encodedPassword): void;

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     */
    public function getSalt(): string|null;

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials();
}
