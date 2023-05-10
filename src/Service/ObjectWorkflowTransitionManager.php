<?php

namespace App\Service;

use App\Interface\Object\ObjectInterface;
use Symfony\Component\Workflow\Registry;

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
