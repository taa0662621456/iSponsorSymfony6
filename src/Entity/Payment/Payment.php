<?php


namespace App\Entity\Payment;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use DateTime;
use Symfony\Component\Uid\Uuid;

class Payment
{
    use BaseTrait;
    use ObjectTrait;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
}
