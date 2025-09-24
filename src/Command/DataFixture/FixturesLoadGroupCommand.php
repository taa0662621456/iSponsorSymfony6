<?php
namespace App\Command\DataFixture;

use App\DataFixtureInterface\GroupedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Loader\SymfonyFixturesLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fixtures:load-group',
    description: 'Load fixtures for a specific group'
)]
class FixturesLoadGroupCommand extends Command
{
    public function __construct(
        private readonly SymfonyFixturesLoader $loader,
        private readonly EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('group', InputArgument::REQUIRED, 'Group name (e.g. core, catalog, promo, order)')
            ->addOption('append', null, InputOption::VALUE_NONE, 'Do not purge the database before loading');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $group = $input->getArgument('group');
        $append = $input->getOption('append');

        $fixtures = array_filter(
            $this->loader->getFixtures(),
            fn($fixture) => $fixture instanceof GroupedFixtureInterface && $fixture::getGroup() === $group
        );

        if (empty($fixtures)) {
            $output->writeln("<error>No fixtures found for group: {$group}</error>");
            return Command::FAILURE;
        }

        usort($fixtures, fn(GroupedFixtureInterface $a, GroupedFixtureInterface $b) => $a::getPriority() <=> $b::getPriority());

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);

        $executor->execute($fixtures, $append);

        $output->writeln("<info>Fixtures for group '{$group}' loaded successfully.</info>");

        return Command::SUCCESS;
    }
}