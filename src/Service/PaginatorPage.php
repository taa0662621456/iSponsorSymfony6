<?php

namespace App\Service;

use JetBrains\PhpStorm\Pure;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class PaginatorPage
{
    private Collection $content;

    private int $totalElements;

    private int $offset;

    private int $limit;

    #[Pure]
    public function __construct()
    {
        $this->content = new ArrayCollection();
    }

    public static function of(Collection $content, int $totalElements, int $offset = 0, int $limit = 20): self
    {
        $page = new self();
        $page->setContent($content)
            ->setTotalElements($totalElements)
            ->setOffset($offset)
            ->setLimit($limit);

        return $page;
    }

    public function getContent(): ArrayCollection|Collection
    {
        return $this->content;
    }
}
