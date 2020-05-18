<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Message\MessageConversation", inversedBy="messages")
     */
    private $conversation;

    private $mine;

    /**
     * @return mixed
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getConversation(): ?MessageConversation
    {
        return $this->conversation;
    }

    /**
     * @param mixed $conversation
     * @return Message
     */
    public function setConversation(?MessageConversation $conversation): self
    {
        $this->conversation = $conversation;
    }

    /**
     * @return mixed
     */
    public function getMine()
    {
        return $this->mine;
    }

    /**
     * @param mixed $mine
     */
    public function setMine($mine): void
    {
        $this->mine = $mine;
    }


}
