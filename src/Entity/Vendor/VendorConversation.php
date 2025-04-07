<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Vendor\VendorConversationInterface;

#[ORM\Entity]
class VendorConversation extends RootEntity implements ObjectInterface, VendorConversationInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: 'vendorMessageConversation', targetEntity: VendorMessage::class)]
    private Collection $vendorConversationMessage;

    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorConversation')]
    private Collection $vendorConversationVendor;

    public function __construct()
    {
        parent::__construct();
        $this->vendorConversationMessage = new ArrayCollection();
        $this->vendorConversationVendor = new ArrayCollection();
    }
}
