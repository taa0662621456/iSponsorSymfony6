<?php

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Repository\Vendor\VendorConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_conversation')]
#[ORM\Index(columns: ['slug'], name: 'vendor_conversation_idx')]
#[ORM\Entity(repositoryClass: VendorConversationRepository::class)]
class VendorConversation
{
    use BaseTrait;

    #[ORM\OneToMany(mappedBy: 'vendorMessage', targetEntity: VendorMessage::class)]
    private Collection $vendorMessage;

    #[ORM\ManyToOne(targetEntity: VendorMessage::class, inversedBy: 'vendorConversation')]
    private Vendor $vendorConversationMessage;

    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorConversation')]
    private Collection $vendorConversationVendor;

    #
    public function __construct()
    {
        $this->vendorMessage = new ArrayCollection();
        $this->vendorConversationVendor = new ArrayCollection();
    }
    # OneToMany
    public function getVendorMessage(): Collection
    {
        return $this->vendorMessage;
    }
    public function addVendorMessage(VendorMessage $vendorMessage): self
    {
        if (!$this->vendorMessage->contains($vendorMessage)) {
            $this->vendorMessage[] = $vendorMessage;
        }
        return $this;
    }
    public function removeVendorMessage(VendorMessage $vendorMessage): self
    {
        if ($this->vendorMessage->contains($vendorMessage)) {
            $this->vendorMessage->removeElement($vendorMessage);
        }

        return $this;
    }
    # ManyToOne
    public function getVendorConversationMessage(): Vendor
    {
        return $this->vendorConversationMessage;
    }
    public function setVendorConversationMessage(Vendor $vendor): void
    {
            $this->vendorConversationMessage = $vendor;
    }
    # OneToMany
    public function getVendorConversationVendor(): Collection
    {
        return $this->vendorConversationVendor;
    }
    public function addVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if (!$this->vendorConversationVendor->contains($vendorConversationVendor)){
            $this->vendorConversationVendor[] = $vendorConversationVendor;
        }
        return $this;
    }
    public function removeVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if ($this->vendorConversationVendor->contains($vendorConversationVendor)){
            $this->vendorConversationVendor->removeElement($vendorConversationVendor);
        }
        return $this;
    }
    #


}
