<?php

namespace App\Interface\Featured;

interface FeaturedInterface
{
    #
    public function setOrdering($ordering): int;
    public function getOrdering(): int;
    #
    public function getFeaturedType(): string;
	public function setFeaturedType(string $featuredType): void;

}
