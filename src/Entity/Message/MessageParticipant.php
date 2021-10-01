<?php


namespace App\Entity\Message;


use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vendor\Vendors;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="participant")
     */
    private $vendor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message\MessageConversation", inversedBy="participants")
     */
    private $conversation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVendor(): ?Vendors
    {
        return $this->vendor;
    }

    public function setVendor(?Vendors $vendor): self
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
