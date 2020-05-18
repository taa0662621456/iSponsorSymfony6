<?php

namespace App\Entity\Message;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Conversation
 * @package App\Entity\Message
 * @ORM\Table(name="conversation", indexes={
 * @ORM\Index(name="last_message_id_idx", columns={"last_message_id"})})
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


}
