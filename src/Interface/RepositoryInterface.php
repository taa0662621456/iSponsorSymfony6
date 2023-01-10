<?php

namespace App\Interface;

use Doctrine\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository
{
    public const ORDER_ASCENDING = 'ASC';

    public const ORDER_DESCENDING = 'DESC';

}
