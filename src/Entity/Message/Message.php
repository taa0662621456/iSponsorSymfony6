<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package App\Entity\Message
 * @ORM\Table(name="message", indexes={
 * @ORM\Index(name="message_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Message\MessageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Message
{
    use BaseTrait;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendor", inversedBy="vendorMessage")
     */
    private Vendor $vendor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message\MessageConversation", inversedBy="message")
     */
    private MessageConversation $conversation;

    private $mine;

    /**
     * @return
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
    }

    /**
     * @return MessageConversation|null
     */
    public function getConversation(): ?MessageConversation
    {
        return $this->conversation;
    }

    /**
     * @param MessageConversation $conversation
     * @return Message
     */
    public function setConversation(MessageConversation $conversation): self
    {
        $this->conversation = $conversation;
    }

    /**
     * @return
     */
    public function getMine()
    {
        return $this->mine;
    }

    /**
     * @param $mine
     */
    public function setMine($mine): void
    {
        $this->mine = $mine;
    }


}
