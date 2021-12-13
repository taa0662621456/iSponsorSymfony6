<?php

namespace App\Interface;

interface FeaturedInterface
{

	/**
	 * @param $ordering
	 *
	 */
    public function setOrdering($ordering): static;


    /**
     * @return integer
     */
    public function getOrdering(): int;


    /**
     * @return string
     */
    public function getFeaturedType(): string;


	/**
	 * @param string $featuredType
	 */
    public function setFeaturedType(string $featuredType): void;

}
