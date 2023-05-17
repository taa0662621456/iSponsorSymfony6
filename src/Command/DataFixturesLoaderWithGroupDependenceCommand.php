<?php

namespace App\Command;

use App\Service\DataFixtures\FixtureGroupLoader;
use Doctrine\Bundle\FixturesBundle\Command\LoadDataFixturesDoctrineCommand;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DataFixturesLoaderWithGroupDependenceCommand extends Command
{
    protected static $defaultName = 'load:fixtures:group-depend';

    private FixtureGroupLoader $fixtureGroupLoader;
    private EntityManagerInterface $entityManager;

    public function __construct(FixtureGroupLoader $fixtureGroupLoader, EntityManagerInterface $entityManager)
    {
        $this->fixtureGroupLoader = $fixtureGroupLoader;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Load data fixtures in the specified order based on group dependencies');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Загружаем фикстуры в определенном порядке на основе зависимостей групп
        $orderedFixtures = $this->fixtureGroupLoader->loadFixturesInOrder();

        // Создаем инстанс Loader для загрузки фикстур
        $loader = new Loader();
        foreach ($orderedFixtures as $fixture) {
            $loader->addFixture($fixture);
        }

        // Очищаем базу данных от существующих данных перед загрузкой фикстур
        $purger = new ORMPurger($this->entityManager);
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures());

        // Создаем экземпляр SymfonyStyle для вывода информации в консоль
        $io = new SymfonyStyle($input, $output);
        $io->writeln('<comment>Loading fixtures...</comment>');

        // Завершаем команду с успешным статусом
        return Command::SUCCESS;
    }

}
