<?php

namespace App\EntityInterface\Product;

interface ProductReviewInterface
{
    public const STATUS_NEW = 'new';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
}
