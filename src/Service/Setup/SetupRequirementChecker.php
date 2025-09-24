<?php

namespace App\Service\Setup;

use App\Service\TableRenderer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SetupRequirementChecker implements RequirementsCheckerInterface
{
    private bool $fulfilled = true;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $helpTable = new TableRenderer($output);
        $helpTable->setHeaders(['Issue', 'Recommendation']);

        foreach ($this->syliusRequirements as $collection) {
            $notFulfilledTable = new TableRenderer($output);
            $notFulfilledTable->setHeaders(['Requirement', 'Status']);
            $this->checkRequirementsInCollection($collection, $notFulfilledTable, $helpTable, $input->getOption('verbose'));
        }

        if (!$helpTable->isEmpty()) {
            $helpTable->render();
        }

        return $this->fulfilled;
    }

    private function checkRequirementsInCollection(
        RequirementCollection $collection,
        TableRenderer $notFulfilledTable,
        TableRenderer $helpTable,
        $verbose,
    ): void {
        /** @var Requirement $requirement */
        foreach ($collection as $requirement) {
            $label = $requirement->getLabel();

            if ($requirement->isFulfilled()) {
                $notFulfilledTable->addRow([$label, '<info>OK!</info>']);

                continue;
            }

            $notFulfilledTable->addRow([$label, $this->getRequirementRequiredMessage($requirement)]);
            $helpTable->addRow([$label, sprintf('<comment>%s</comment>', $requirement->getHelp())]);
        }

        if ($verbose || !$this->fulfilled) {
            $notFulfilledTable->setLabel($collection->getLabel());
            $notFulfilledTable->render();
        }
    }

    private function getRequirementRequiredMessage(Requirement $requirement): string
    {
        if ($requirement->isRequired()) {
            $this->fulfilled = false;

            return '<error>ERROR!</error>';
        }

        return '<comment>WARNING!</comment>';
    }
}