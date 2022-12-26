<?php
//https://qwertybox.ru/articles/22530/
namespace App\Service\BinApp;

use Symfony\Bundle\FrameworkBundle\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\ListCommand;

class BinAppConsole extends BaseApplication
{
    private function isCommandVisible(Command $command): bool
    {
        // we need to leave "list" command as is used for help
        if ($command instanceof ListCommand) {
            return true;
        }

        // we only want commands from app namesapce
        if (str_starts_with($command->getName(), 'app:')) {
            return true;
        }

        return false;
    }

//    public function add(Command $command)
//    {
//        if (!$this->isCommandVisible($command)) {
//            return null;
//        }
//
//        return parent::add($command);
//    }

}
