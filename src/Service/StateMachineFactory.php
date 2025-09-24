<?php

namespace App\Service;

use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Definition;
use Symfony\Component\Workflow\StateMachine;
use App\Interface\StateMachine\StateMachineFactoryInterface;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;

class StateMachineFactory implements StateMachineFactoryInterface
{
    private Registry $workflowRegistry;

    public function __construct()
    {
        // Инициализация реестра Workflow
        $this->workflowRegistry = new Registry();
    }

    public function create(string $name, array $places, array $transitions, string $initialPlace): StateMachine
    {
        // Создание определения конечного автомата
        $definition = new Definition($places, $transitions, $initialPlace);

        // Создание хранилища для отслеживания состояний
        $markingStore = new MethodMarkingStore(true, 'currentState');

        // Создание конечного автомата
        $stateMachine = new StateMachine($definition, $markingStore, $this->workflowRegistry);

        // Регистрация конечного автомата в реестре
        $this->workflowRegistry->addWorkflow($stateMachine, $name);

        return $stateMachine;
    }
}