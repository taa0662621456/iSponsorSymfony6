<?php

namespace App\Service;


final class TokenUniquenessChecker
{
    public function __construct(private $repository, private readonly string $tokenFieldName)
    {
    }

    public function isUnique(string $token): bool
    {
        return null === $this->repository->findOneBy([$this->tokenFieldName => $token]);
    }
}
