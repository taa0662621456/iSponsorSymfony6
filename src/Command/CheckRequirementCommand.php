<?php

namespace App\Command;

use RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CheckRequirementCommand extends AbstractCommand
{
    protected static $defaultName = 'install:check-requirement';

    protected function configure(): void
    {
        $this
            ->setDescription('Checks if all Sylius requirements are satisfied.')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command checks system requirements.
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fulfilled = $this->getContainer()->get('installer.checker.requirement')->check($input, $output);

        if (!$fulfilled) {
            throw new RuntimeException(
                'Some system requirements are not fulfilled. Please check output messages and fix them.',
            );
        }

        $output->writeln('<info>Success! Your system can run iSponsor.</info>');

        return 0;
    }
}
