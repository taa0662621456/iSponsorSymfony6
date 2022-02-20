<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
use App\Entity\Vendor\Vendor;
use App\Repository\Message\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package App\Entity\Message
 */
#[ORM\Table(name: 'message')]
#[ORM\Index(columns: ['slug'], name: 'message_idx')]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Message
{
    use BaseTrait;
    #[ORM\Column(type: 'text')]
    private mixed $content;
    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMessage')]
    private Vendor $vendor;
    #[ORM\ManyToOne(targetEntity: MessageConversation::class, inversedBy: 'message')]
    private MessageConversation $conversation;

    #[ORM\Column(type: 'text')]
    private mixed $mine;

    /**
     * @return mixed
     */
    public function getContent(): mixed
    {
        return $this->content;
    }
    public function setContent(string $content): self
    {
        $this->content = $content;
    }
    public function getConversation(): ?MessageConversation
    {
        return $this->conversation;
    }
    public function setConversation(MessageConversation $conversation): self
    {
        $this->conversation = $conversation;
    }

    /**
     * @return mixed
     */
    public function getMine(): mixed
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
