<?php

namespace App\Command\User;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PromoteUserCommand extends AbstractRoleCommand
{
    protected static $defaultName = 'user:role:promote';

    protected function configure(): void
    {
        $this
            ->setDescription('Promotes a user by adding roles.')
            ->setDefinition([
                new InputArgument('email', InputArgument::REQUIRED, 'Email'),
                new InputArgument('roles', InputArgument::IS_ARRAY, 'Security roles'),
                new InputOption('super-admin', null, InputOption::VALUE_NONE, 'Set the user as a super admin'),
                new InputOption('user-type', null, InputOption::VALUE_REQUIRED, 'User type'),
            ])
            ->setHelp(
                <<<EOT
The <info>sylius:user:promote</info> command promotes a user by adding security roles

  <info>php app/console sylius:user:promote matthieu@email.com</info>
EOT
            )
        ;
    }

    protected function executeRoleCommand(InputInterface $input, OutputInterface $output, UserInterface $user, array $securityRoles): void
    {
        $error = false;
        $successMessages = [];

        foreach ($securityRoles as $securityRole) {
            if ($user->hasRole($securityRole)) {
                $output->writeln(sprintf('<error>User "%s" already has "%s" security role.</error>', $user->getEmail(), $securityRole));
                $error = true;

                continue;
            }

            $user->addRole($securityRole);
            $successMessages[] = sprintf('Security role <comment>%s</comment> has been added to user <comment>%s</comment>', $securityRole, $user->getEmail());
        }

        if (!$error) {
            $output->writeln($successMessages);
            $this->getEntityManager($input->getOption('user-type'))->flush();
        } else {
            $output->writeln(sprintf('<error>No roles added to User "%s".</error>', $user->getEmail()));
        }
    }
}
