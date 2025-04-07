<?php

namespace App\Service;

use Symfony\Component\Workflow\Registry;
use App\EntityInterface\Object\ObjectInterface;

class ObjectWorkflowTransitionManager
{
    private Registry $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->workflowRegistry = $workflowRegistry;
    }

    public function applyTransition(ObjectInterface $review, string $targetState): void
    {
        $workflow = $this->workflowRegistry->get($review);
        if ($workflow->can($review, $targetState)) {
            $workflow->apply($review, $targetState);
        }
    }
}
