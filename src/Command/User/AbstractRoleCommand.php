<?php

namespace App\Command\User;

use App\Interface\VendorRepositoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

abstract class AbstractRoleCommand extends Command
{
    /**
     * @throws \Exception
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $availableUserTypes = $this->getAvailableUserTypes();
        if (empty($availableUserTypes)) {
            throw new \Exception(sprintf('At least one user type should implement %s', UserInterface::class));
        }

        $helper = $this->getHelper('question');
        Assert::isInstanceOf($helper, QuestionHelper::class);
        if (!$input->getOption('user-type')) {
            // Do not ask if there's only 1 user type configured
            if (count($availableUserTypes) === 1) {
                $input->setOption('user-type', $availableUserTypes[0]);
            } else {
                $question = new ChoiceQuestion('Please enter the user type:', $availableUserTypes, 1);
                $question->setErrorMessage('Choice %s is invalid.');
                $userType = $helper->ask($input, $output, $question);
                $input->setOption('user-type', $userType);
            }
        }

        if (!$input->getArgument('email')) {
            $question = new Question('Please enter an email:');
            $question->setValidator(function (?string $email) {
                if (!filter_var($email, \FILTER_VALIDATE_EMAIL)) {
                    throw new \RuntimeException('The email you entered is invalid.');
                }

                return $email;
            });
            $email = $helper->ask($input, $output, $question);
            $input->setArgument('email', $email);
        }

        if (!$input->getArgument('roles')) {
            $question = new Question('Please enter user\'s roles (separated by space):');
            $question->setValidator(function (?string $roles) {
                if ('' === $roles) {
                    throw new \RuntimeException('The value cannot be blank.');
                }

                return $roles;
            });
            $roles = $helper->ask($input, $output, $question);

            if (!empty($roles)) {
                $input->setArgument('roles', explode(' ', $roles));
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $securityRoles = $input->getArgument('roles');
        $superAdmin = $input->getOption('super-admin');
        $userType = $input->getOption('user-type');

        if ($superAdmin) {
            $securityRoles[] = 'ROLE_ADMINISTRATION_ACCESS';
        }

        /** @var UserInterface $user */
        $user = $this->findUserByEmail($email, $userType);

        $this->executeRoleCommand($input, $output, $user, $securityRoles);

        return 0;
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function findUserByEmail(string $email, string $userType): UserInterface
    {
        /** @var UserInterface|null $user */
        $user = $this->getUserRepository($userType)->findOneByEmail($email);

        if (null === $user) {
            throw new \InvalidArgumentException(sprintf('Could not find user identified by email "%s"', $email));
        }

        return $user;
    }

    protected function getEntityManager(string $userType): ObjectManager
    {
        $class = $this->getUserModelClass($userType);

        return $this->getContainer()->get('doctrine')->getManagerForClass($class);
    }

    protected function getUserRepository(string $userType): VendorRepositoryInterface
    {
        $class = $this->getUserModelClass($userType);

        return $this->getEntityManager($userType)->getRepository($class);
    }

    protected function getAvailableUserTypes(): array
    {
        $config = $this->getContainer()->getParameter('user.users');

        // Keep only users types which implement \SyliusInterface
        $userTypes = array_filter($config, fn (array $userTypeConfig): bool => isset($userTypeConfig['user']['classes']['model']) && is_a($userTypeConfig['user']['classes']['model'], UserInterface::class, true));

        return array_keys($userTypes);
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function getUserModelClass(string $userType): string
    {
        $config = (array) $this->getContainer()->getParameter('user.users');
        if (empty($config[$userType]['user']['classes']['model'])) {
            throw new \InvalidArgumentException(sprintf('User type %s misconfigured.', $userType));
        }

        return $config[$userType]['user']['classes']['model'];
    }

    abstract protected function executeRoleCommand(InputInterface $input, OutputInterface $output, UserInterface $user, array $securityRoles): void;
}
