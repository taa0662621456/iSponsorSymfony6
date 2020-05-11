<?php
/**
 * урок по созданию чата на Сокетах
 * https://www.youtube.com/watch?v=wnr2A4aKnPU
 */

namespace App\Entity\Message;

use App\Entity\BaseTrait;

/**
 * Class Message
 * @package App\Entity\Messenger
 * @ORM\Table(name="message", indexes={
 * @ORM\Index(name="created_by_idx", columns={"created_by"})})
 * @ORM\Entity(repositoryClass="App\Repository\Conversation\MesssageRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Message
{
    use BaseTrait;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * тут должно быть свойство Юзер с отношением к Вендор и Инверсием messages,
     * которая встречается ниже
     */

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Messenger\Conversation", inversedBy="messages")
     */
    private $conversation;


}
