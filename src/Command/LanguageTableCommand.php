<?php

namespace App\Command;

use App\Service\ObjectInitializer;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\Orm\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Output\OutputInterface;
use function count;

/**
 * @property $requestDispatcher
 */
class LanguageTableCommand extends Command
{
    use LockableTrait;

    private ManagerRegistry $managerRegistry;

    private Connection $connection;

    protected static $defaultDescription = 'Generate Object language Table in Postgres. Эта команда создает таблицу объекта в базе данных с использованием аргумента - суффикса/постфикса - языка. Например: ObjectRuRU или ObjectMediaRuRU. RuRU - суффикс';

    protected static $defaultName = 'generate-translation-table';

    public function __construct(
        ManagerRegistry $managerRegistry,
        private readonly ObjectInitializer $objectInitializer,
        Connection $connection,
        string $name = null
    ) {
        parent::__construct($name);
        $this->managerRegistry = $managerRegistry;
        $this->connection = $connection;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate Object language Table in Postgres')
            ->addArgument('object', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Object Entity Name(s). Ex.: Object ObjectAttachment ... .  Use space as separator')
            ->addArgument('language', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Language Entity Suffix(es). Ex. "Object [RuRU] .php". Use space as separator')
            ->setHelp('Эта команда создает таблицу объекта в базе данных с использованием аргумента - суффикса/постфикса - языка. Например: ObjectRuRU или ObjectMediaRuRU. RuRU - суффикс')
            ->setHidden();
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::FAILURE;
        }

        $output->writeln('Create Translation table');
        $output->writeln('Object. Press Enter for empty: '.$input->getArgument('object'));
        $output->writeln('Language. Press Enter for empty: '.$input->getArgument('language'));

        $object = $input->getArgument('object');
        $language = $input->getArgument('language');

        if (0 != count($object) || 0 != count($language)) {
            $summery = [];

            for ($o = 0; $o <= count($object); $o++) {
                for ($l = 0; $l <= count($language); $l++) {
                    $r = $object[$o].$language[$l];

                    $summery[] = [$r];

                    $output->writeln($summery);
                }
            }

            for ($i = 0; $i <= count($summery); $i++) {
                $o = $object[$i].'EnUS';

                $this->tableQuery($summery[$i], $o);
            }
        }

        //        if (null == $object AND null == $language) {
        if (!$object && !$language) {
            $object = $this->requestDispatcher->object();
            $objectEnUS = $object.'EnUS';
            $object = $object.$this->requestDispatcher->localeFilter();

            $this->tableQuery($object, $objectEnUS);
        }

        return Command::SUCCESS;
    }

    /**
     * @throws Exception
     */
    public function tableQuery(string $object, string $objectEnUS): void
    {
        $em = $this->managerRegistry->getManager();

        $q = $em->createQuery(
            'CREATE TABLE IF NOT EXISTS'.$object.'
             AS (SELECT 1 FROM information_schema.columns WHERE table_name ='.$objectEnUS.')
             WITH NO DATA'
        );

        $s = $this->connection->prepare($q);
        $s->executeQuery();

        try {
            $t = $q->getSingleResult();
        } catch (NoResultException $e) {
            $t = null;
        }
    }
}
