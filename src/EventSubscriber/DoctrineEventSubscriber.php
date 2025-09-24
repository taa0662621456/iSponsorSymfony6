<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use JetBrains\PhpStorm\ArrayShape;
use Doctrine\Common\EventSubscriber;

class DoctrineEventSubscriber implements EventSubscriber
{
    // TODO: слушаем доктрину, чтобы в соответствии с CRUD-операциями в БД выполнять
    // CRUD-операции над связанными файлами

    #[ArrayShape([
        Events::preRemove => 'string',
        Events::postRemove => 'string',
        Events::postPersist => 'string',
        Events::postUpdate => 'string',
    ])]
    public function getSubscribedEvents(): array
    {
        return [
            Events::preRemove => 'preRemove',
            Events::postRemove => 'postRemove',
            Events::postPersist => 'postPersist',
            Events::postUpdate => 'postUpdate',
        ];
    }

    public function postUpdate()
    {
    }

    public function postPersist()
    {
    }

    public function postRemove()
    {
    }

    public function preRemove()
    {
    }
}