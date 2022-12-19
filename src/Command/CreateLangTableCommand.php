<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateLangTableCommand extends Command
{
    protected static $defaultDescription = 'Generate Object language Table in Postgres. Эта команда создает таблицу объекта в базе данных с использованием аргумента - суффикса/постфикса - языка. Например: ObjectRuRu или ObjectMediaRuRu. RuRu - суффикс';
    protected static $defaultName = 'app:generate-lang-table';
//    private bool $requirePassword;

//    public function __construct(bool $requirePassword = false)
//    {
//        // best practices recommend to call the parent constructor first and
//        // then set your own properties. That wouldn't work in this case
//        // because configure() needs the properties set in this constructor
//        $this->requirePassword = $requirePassword;
//
//        parent::__construct();
//    }

    // TODO: код по генерации таблицы в базе данных и в случае успеха return Command::SUCCESS;
    // в случае неуспеха return Command::FAILURE;
    // в случае неправильных параметров или аргументов return Command::INVALID
    // хелп https://symfony.com/doc/current/console.html

    protected function configure()
    {
        $this
//            ->setDescription('Generate Object language Table in Postgre')
            ->addArgument('language', InputArgument::OPTIONAL, 'Language Entity Suffix. Ex. ObjectRuRu.php')
            ->setHelp('Эта команда создает таблицу объекта в базе данных с использованием аргумента - суффикса/постфикса - языка. Например: ObjectRuRu или ObjectMediaRuRu. RuRu - суффикс')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $language = $input->getArgument('language');

        if ($language) {
            $io->note(sprintf('You passed an argument (Вы не указали язык-суффикс таблицы): %s', $language));

        }
        $io->success('Команда по созданию таблиц языковых слоев объектов! Pass --help to see your options.');

        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
        $output->writeln($this->someMethod());

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('create a user.');

        return Command::SUCCESS;


    }

    private function someMethod(): ?int
    {
        return 1;
    }

}
