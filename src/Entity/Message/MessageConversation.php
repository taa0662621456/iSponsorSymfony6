<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
use App\Repository\Message\MessageConversationRepository;
use App\Service\RequestDispatcher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Table(name: 'message_conversation')]
#[ORM\Index(columns: ['slug'], name: 'conversation_idx')]
#[ORM\Entity(repositoryClass: MessageConversationRepository::class)]
class MessageConversation
{
    use BaseTrait;
    #[ORM\OneToMany(mappedBy: 'conversation', targetEntity: MessageParticipant::class)]
    private ArrayCollection $participants;
    #[ORM\OneToOne(targetEntity: Message::class)]
    #[ORM\JoinColumn(name: 'last_message_id', referencedColumnName: 'id')]
    private Message $lastMessage;
    #[ORM\OneToMany(mappedBy: 'conversation', targetEntity: Message::class)]
    private ArrayCollection $message;
    #[Pure] public function __construct(RequestDispatcher $requestDispatcher)
    {
        //parent::__construct($requestDispatcher);

        $this->participants = new ArrayCollection();
        $this->message = new ArrayCollection();
    }
    public function getParticipants(): ArrayCollection
    {
        return $this->participants;
    }
    /**
     * @param $participants
     */
    public function setParticipants($participants): void
    {
        $this->participants = $participants;
    }
    public function getLastMessage(): Message
    {
        return $this->lastMessage;
    }
    /**
     * @param $lastMessage
     */
    public function setLastMessage($lastMessage): void
    {
        $this->lastMessage = $lastMessage;
    }
    /**
     * @return ArrayCollection|Message[]
     */
    public function getMessage(): array|ArrayCollection
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
