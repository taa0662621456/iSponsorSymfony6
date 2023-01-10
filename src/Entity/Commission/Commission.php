<?php


namespace App\Entity\Commission;


use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Factory\EntityFactory;
use DateTime;
use Symfony\Component\Uid\Uuid;

class Commission
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    //TODO: комиссии, налагаемые на способы доставки, оплаты и пр.
    /**
     * incrementCommission
     * decrementCommission
     * additionCommission
     * multiplicationCommission
     * subtractionCommission
     *
     * percentCommission
     * fixedCommission
     *
     * toShipment
     * toPayment
     * toPrice
     * toDate
     * toPlatformReward
     * toStorage
     * toProjectType
     * toOrderTotal
     * toProductCategory
     *
     *
     */
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
