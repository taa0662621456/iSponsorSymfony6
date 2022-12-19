<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CancelUnpaidOrderCommand extends Command
{
    protected static $defaultName = 'cancel-unpaid-orders';

    protected function configure(): void
    {
        $this
            ->setDescription(
                'Removes order that have been unpaid for a configured period. Configuration parameter - order.order_expiration_period.',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $expirationTime = $this->getApplication()->get('order.order_expiration_period');
        $output->writeln(sprintf(
            'Command will cancel orders that have been unpaid for <info>%s</info>.',
            (string) $expirationTime,
        ));

        $unpaidCartsStateUpdater = $this->getApplication()->get('unpaid_order');
        $unpaidCartsStateUpdater->cancel();

        $this->getApplication()->get('manager.order')->flush();

        $output->writeln('<info>Unpaid orders have been canceled</info>');

        return 0;
    }
}
