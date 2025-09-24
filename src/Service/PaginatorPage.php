<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

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


    public static function of(Collection $content, int $totalElements, int $offset = 0, int $limit = 20): PaginatorPage
    {
        $page = new PaginatorPage();
        $page->setContent($content)
            ->setTotalElements($totalElements)
            ->setOffset($offset)
            ->setLimit($limit);

        return $page;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getContent(): ArrayCollection|Collection
    {
        return $this->content;
    }





}