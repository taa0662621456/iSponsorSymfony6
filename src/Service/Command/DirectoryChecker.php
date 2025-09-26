<?php

namespace App\Service\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class DirectoryChecker extends Command
{

    protected function directoryChecker(string $directory, OutputInterface $output): void
    {
        $checker = $this->getApplication()->get('installer.checker.command_directory');
        $checker->setCommandName($this->getName());

        $checker->ensureDirectoryExists($directory, $output);
        $checker->ensureDirectoryIsWritable($directory, $output);
    }

}
