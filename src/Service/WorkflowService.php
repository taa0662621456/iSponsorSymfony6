<?php

namespace App\Service;

use App\Entity\Embeddable\ObjectProperty;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\StateMachine;
use Symfony\Component\Workflow\Transition;

class WorkflowService
{
    private StateMachine $workflow;

    public function __construct()
    {
        $definitionBuilder = new DefinitionBuilder();

        $definition = $definitionBuilder
            ->addPlaces(['submitted', 'review', 'published', 'archived'])
            ->addTransition(new Transition('to_review', 'submitted', 'review'))
            ->addTransition(new Transition('publish', 'review', 'published'))
            ->addTransition(new Transition('archive', 'published', 'archived'))
            ->build();

        $this->workflow = new StateMachine(
            $definition,
            new MethodMarkingStore(true, 'currentState')
        );
    }

    public function applyTransition(ObjectProperty $objectProperty, string $transition): bool
    {
        if ($this->workflow->can($objectProperty, $transition)) {
            $this->workflow->apply($objectProperty, $transition);
            return true;
        }

        return false;
    }

    public function getAvailableTransitions(ObjectProperty $objectProperty): array
    {
        return array_map(
            fn($t) => $t->getName(),
            $this->workflow->getEnabledTransitions($objectProperty)
        );
    }
}
