<?php


namespace App\Entity\Message;


use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vendor\Vendor;

/**
 * Class MessageParticipant
 * @package App\Entity\Message
 * @ORM\Table(name="message_participant")
 *
 * @ORM\Entity(repositoryClass="App\Repository\Message\MessageParticipantRepository")
 *
 */
class MessageParticipant
{
    use BaseTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendor", inversedBy="participant")
     */
    private Vendor $vendor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message\MessageConversation", inversedBy="participants")
     */
    private MessageConversation $conversation;

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getConversation(): ?MessageConversation
    {
        return $this->conversation;
    }

    public function setConversation(?MessageConversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }
}
