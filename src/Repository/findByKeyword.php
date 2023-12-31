<?php

namespace App\Repository;

use App\Service\PaginatorPage;
use Doctrine\Common\Collections\ArrayCollection;

trait findByKeyword
{
    public function findByKeyword(string $q, int $offset = 0, int $limit = 20): PaginatorPage
    {
        $query = $this->$this->createQueryBuilder('o')
            ->andWhere('o.first_title like :q or o.last_title like :q')
            ->setParameter('q', '%'.$q.'%')
            ->orderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $c = \count($paginator);
        $content = new ArrayCollection();
        foreach ($paginator as $post) {
            $content->add(PostSummaryDto::of($post->getId(), $post->getFirstTitle()));
        }

        return PaginatorPage::of($content, $c, $offset, $limit);
    }
    // https://dev.to/hantsy_26/-building-restful-apis-with-symfony-5-and-php-8-1p2e
}
