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
 * @ORM\Entity(repositoryClass="App\Repository\Message\ConversationRepository")
 *
 */
class Conversation
{

    use BaseTrait;

    /**
     * @ORM\OnyToMany(targetEntity="App\Entity\Messenger\Patricipants", mappedBy="conversation")
     */
    private $participants;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Messenger\Message"
     * @ORM\JoinColumn(name="last_message_id", referencedColumnName="id")
     */
    private $lastMessage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Messenger\Message", mappedBy="conversation")
     */
    private $message;


}
