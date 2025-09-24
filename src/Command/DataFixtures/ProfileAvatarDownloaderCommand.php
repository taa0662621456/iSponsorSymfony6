<?php

namespace App\Command\DataFixtures;

use App\Service\ThisPersonDoesNotExist\ThisPersonDoesNotExistDownloader;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProfileAvatarDownloaderCommand extends Command
{
    protected static $defaultName = 'app:avatar-download';

    private ThisPersonDoesNotExistDownloader $downloader;

    public function __construct(ThisPersonDoesNotExistDownloader $downloader)
    {
        parent::__construct();
        $this->downloader = $downloader;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Downloads a number of avatars from a specified URL.')
            ->addOption('count', null, InputOption::VALUE_OPTIONAL, 'The number of avatars to download', 1);
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = $input->getOption('count');
        for ($i = 0; $i < $count; $i++) {
            $filename = $this->downloader->profileAvatarDownloaderByURL();
            $output->writeln("Downloaded avatar: $filename");
        }

        return Command::SUCCESS;
    }
}