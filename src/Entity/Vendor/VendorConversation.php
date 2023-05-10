<?php

namespace App\Entity\Vendor;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorConversationInterface;
use App\Repository\Vendor\VendorConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_conversation')]
#[ORM\Entity(repositoryClass: VendorConversationRepository::class)]


final class VendorConversation extends ObjectSuperEntity implements ObjectInterface, VendorConversationInterface
{
    #[ORM\OneToMany(mappedBy: 'vendorMessageConversation', targetEntity: VendorMessage::class)]
    private Collection $vendorConversationMessage;

    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorConversation')]
    private Collection $vendorConversationVendor;

    public function __construct()
    {
        $this->vendorConversationMessage = new ArrayCollection();
        $this->vendorConversationVendor = new ArrayCollection();
    }

    // OneToMany
    public function getVendorConversationMessage(): Collection
    {
        return $this->vendorConversationMessage;
    }

    public function addVendorMessage(VendorMessage $vendorMessage): self
    {
        if (!$this->vendorConversationMessage->contains($vendorMessage)) {
            $this->vendorConversationMessage[] = $vendorMessage;
        }

        return $this;
    }

    public function removeVendorMessage(VendorMessage $vendorMessage): self
    {
        if ($this->vendorConversationMessage->contains($vendorMessage)) {
            $this->vendorConversationMessage->removeElement($vendorMessage);
        }

        return $this;
    }

    // OneToMany
    public function getVendorConversationVendor(): Collection
    {
        return $this->vendorConversationVendor;
    }

    public function addVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if (!$this->vendorConversationVendor->contains($vendorConversationVendor)) {
            $this->vendorConversationVendor[] = $vendorConversationVendor;
        }

        return $this;
    }

    public function removeVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if ($this->vendorConversationVendor->contains($vendorConversationVendor)) {
            $this->vendorConversationVendor->removeElement($vendorConversationVendor);
        }

        return $this;
    }
}
