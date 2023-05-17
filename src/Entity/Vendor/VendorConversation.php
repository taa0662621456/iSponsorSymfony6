<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Vendor\VendorConversationInterface;

#[ORM\Entity]
class VendorConversation extends ObjectSuperEntity implements ObjectInterface, VendorConversationInterface
{
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
