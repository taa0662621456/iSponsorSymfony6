<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
use App\Service\RequestDispatcher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Conversation
 * @package App\Entity\Message
 * @ORM\Table(name="message_conversation", indexes={
 * @ORM\Index(name="conversation_idx", columns={"slug"})})
 *
 * @ORM\Entity(repositoryClass="App\Repository\Message\MessageConversationRepository")
 *
 */
class MessageConversation
{

    use BaseTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\MessageParticipant", mappedBy="conversation")
     */
    private $participants;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Message\Message")
     * @ORM\JoinColumn(name="last_message_id", referencedColumnName="id")
     */
    private $lastMessage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message\Message", mappedBy="conversation")
     */
    private $message;

    public function __construct(RequestDispatcher $requestDispatcher)
    {
        //parent::__construct($requestDispatcher);

        $this->participants = new ArrayCollection();
        $this->message = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants): void
    {
        $this->participants = $participants;
    }

    /**
     * @return mixed
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * @param mixed $lastMessage
     */
    public function setLastMessage($lastMessage): void
    {
        $this->lastMessage = $lastMessage;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setConversation($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->contains($message)) {
            $this->message->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getConversation() === $this) {
                $message->setConversation(null);
            }
        }

        return $this;
    }


}
