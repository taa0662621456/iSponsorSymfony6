<?php

namespace App\Interface\Featured;

interface FeaturedInterface
{
    public function setOrdering(int $ordering): void;

    public function getOrdering(): int;

    public function getFeaturedType(): string;

    public function setFeaturedType(string $featuredType): void;
}
