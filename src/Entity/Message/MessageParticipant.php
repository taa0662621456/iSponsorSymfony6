<?php


namespace App\Entity\Message;


use App\Entity\BaseTrait;
use App\Repository\Message\MessageParticipantRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vendor\Vendor;

#[ORM\Table(name: 'message_participant')]
#[ORM\Entity(repositoryClass: MessageParticipantRepository::class)]
class MessageParticipant
{
    use BaseTrait;
    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'participant')]
    private Vendor $vendor;

    #[ORM\ManyToOne(targetEntity: MessageConversation::class, inversedBy: 'participants')]
    private MessageConversation $conversation;
    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }
    public function setVendor(Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }
    public function getConversation(): ?MessageConversation
    {
        return $this->conversation;
    }
    public function setConversation(MessageConversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }
}
