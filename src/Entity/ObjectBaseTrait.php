<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use JetBrains\PhpStorm\Pure;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\StateMachine;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;

trait ObjectBaseTrait
{

}