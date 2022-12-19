<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @final
 */
class CancelUnpaidOrderCommand
{
    protected static string $defaultName = 'cancel-unpaid-orders';

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
        $expirationTime = $this->getContainer()->getParameter('order.order_expiration_period');
        $output->writeln(sprintf(
            'Command will cancel orders that have been unpaid for <info>%s</info>.',
            (string) $expirationTime,
        ));

        $unpaidCartsStateUpdater = $this->getContainer()->get('unpaid_orders_state_updater');
        $unpaidCartsStateUpdater->cancel();

        $this->getContainer()->get('manager.order')->flush();

        $output->writeln('<info>Unpaid orders have been canceled</info>');

        return 0;
    }
}
