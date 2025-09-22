<?php

namespace App\Command\Vendor;

use App\Entity\Vendor\Vendor;
use App\Repository\Vendor\VendorRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * A console command that lists all the existing users.
 *
 * To use this command, open a terminal window, enter into your project directory
 * and execute the following:
 *
 *     $ php bin/console app:list-users
 *
 * Check out the code of the src/Command/AddUserCommand.php file for
 * the full explanation about Symfony commands.
 *
 * See https://symfony.com/doc/current/console.html
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
#[AsCommand(
    name: 'app:list-users',
    description: 'Lists all the existing users',
    aliases: ['app:users']
)]
class VendorListCommand extends Command
{
    public function __construct(
        private readonly MailerInterface $mailer,
//        private readonly string          $emailSender,
        private readonly VendorRepository $users
    ) {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setHelp(<<<'HELP'
                The <info>%command.name%</info> command lists all the users registered in the application:

                  <info>php %command.full_name%</info>

                By default the command only displays the 50 most recent users. Set the number of
                results to display with the <comment>--max-results</comment> option:

                  <info>php %command.full_name%</info> <comment>--max-results=2000</comment>

                In addition to displaying the user list, you can also send this information to
                the email address specified in the <comment>--send-to</comment> option:

                  <info>php %command.full_name%</info> <comment>--send-to=fabien@symfony.com</comment>
                HELP
            )
            // commands can optionally define arguments and/or options (mandatory and optional)
            // see https://symfony.com/doc/current/components/console/console_arguments.html
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, 'Limits the number of users listed', 50)
            ->addOption('send-to', null, InputOption::VALUE_OPTIONAL, 'If set, the result is sent to the given email address')
        ;
    }

    /**
     * This method is executed after initialize(). It usually contains the logic
     * to execute to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $maxResults = $input->getOption('max-results');
        // Use ->findBy() instead of ->findAll() to allow result sorting and limiting
        $allUsers = $this->users->findBy([], ['id' => 'DESC'], $maxResults);

        // Doctrine query returns an array of objects and we need an array of plain arrays
        $usersAsPlainArrays = array_map(static function (Vendor $user) {
            return [
                $user->getId(),
                $user->getVendorEnGbVendor(),
                $user->getVendorIban(),
                implode(', ', []),
            ];
        }, $allUsers);

        // In your console commands you should always use the regular output type,
        // which outputs contents directly in the console window. However, this
        // command uses the BufferedOutput type instead, to be able to get the output
        // contents before displaying them. This is needed because the command allows
        // to send the list of users via email with the '--send-to' option
        $bufferedOutput = new BufferedOutput();
        $io = new SymfonyStyle($input, $bufferedOutput);
        $io->table(
            ['ID', 'EnGb', 'Iban', 'Roles'],
            $usersAsPlainArrays
        );

        // instead of just displaying the table of users, store its contents in a variable
        $usersAsATable = $bufferedOutput->fetch();
        $output->write($usersAsATable);

        if (null !== $email = $input->getOption('send-to')) {
            $this->sendReport($usersAsATable, $email);
        }

        return Command::SUCCESS;
    }

    /**
     * Sends the given $contents to the $recipient email address.
     * @throws TransportExceptionInterface
     */
    private function sendReport(string $contents, string $recipient): void
    {
        $email = (new Email())
            ->from($this->emailSender)
            ->to($recipient)
            ->subject(sprintf('app:list-users report (%s)', date('Y-m-d H:i:s')))
            ->text($contents);

        $this->mailer->send($email);
    }
}
