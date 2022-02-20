<?php

namespace App\Interface;

interface FeaturedInterface
{

	/**
	 * @param $ordering
	 *
	 */
    public function setOrdering($ordering): static;


    public function getOrdering(): int;


    public function getFeaturedType(): string;


	public function setFeaturedType(string $featuredType): void;

}
