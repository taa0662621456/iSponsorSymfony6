<?php

namespace App\Command\Security;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DemoteRoleCommand
    //extends AbstractVendorRoleCommand
{
//    protected static $defaultName = 'user:role:demote';
//
//    protected function configure(): void
//    {
//        $this
//            ->setDescription('Demotes a user by removing a role.')
//            ->setDefinition([
//                new InputArgument('email', InputArgument::REQUIRED, 'Email'),
//                new InputArgument('roles', InputArgument::IS_ARRAY, 'Security roles'),
//                new InputOption('super-admin', null, InputOption::VALUE_NONE, 'Unset the user as super admin'),
//                new InputOption('user-type', null, InputOption::VALUE_REQUIRED, 'Use shop or admin user type'),
//            ])
//            ->setHelp(
//                <<<'EOT'
//The <info>sylius:user:demote</info> command demotes a user by removing security roles
//
//  <info>php app/console sylius:user:demote matthieu@email.com</info>
//EOT
//            );
//    }
//
//    protected function executeRoleCommand(
//        InputInterface $input,
//        OutputInterface $output,
//        array $securityRoles
//    ): void {
//        $error = false;
//        $successMessages = [];
//
//        foreach ($securityRoles as $securityRole) {
//            if (!$user->hasRole($securityRole)) {
//                $output->writeln(sprintf('<error>User "%s" doesn\'t have "%s" Security role.</error>', $user->getEmail(), $securityRole));
//                $error = true;
//
//                continue;
//            }
//
//            $user->removeRole($securityRole);
//            $successMessages[] = sprintf('Security role <comment>%s</comment> has been removed from user <comment>%s</comment>', $securityRole, $user->getEmail());
//        }
//
//        if (!$error) {
//            $output->writeln($successMessages);
//            $this->getEntityManager($input->getOption('user-type'))->flush();
//        } else {
//            $output->writeln(sprintf('<error>No roles removed from User "%s".</error>', $user->getEmail()));
//        }
//    }
}
