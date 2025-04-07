<?php

namespace App\Command\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorSecurity;
use App\Service\Security\PasswordGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use RuntimeException;

#[AsCommand(
    name: 'app:add-vendor',
    description: 'Creates users and stores them in the database'
)]
class AddVendorCommand extends Command
{
    private SymfonyStyle $io;


    public function __construct(
        private readonly EntityManagerInterface      $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly PasswordGenerator $passwordGenerator
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp($this->getCommandHelp())
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the new user')
            ->addArgument('password', InputArgument::OPTIONAL, 'The plain password of the new user')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the new user')
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the new user')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        while (!$username) {
            $username = $this->io->ask('Username');
        }
        $input->setArgument('username', $username);

        $password = $input->getArgument('password');
        if (!$password) {
            $password = $this->passwordGenerator->generatePassword();
        }
        $input->setArgument('password', $password);

        $email = $input->getArgument('email');
        if (!$email) {
            $email = $username . '@' . $username . '.com';
        }
        $input->setArgument('email', $email);

        $name = $input->getArgument('name');
        if (!$name) {
            $name = $username;
        }
        $input->setArgument('name', $name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $plainPassword = $input->getArgument('password');
        $email = $input->getArgument('email');
        $name = $input->getArgument('name');

        $this->validateUserData($username, $plainPassword, $email, $name);

        $vendor = new Vendor();

        $vendorSecurity = new VendorSecurity();
        $vendorSecurity->setUsername($username);
        $vendorSecurity->setEmail($email);
        $hashedPassword = $this->passwordHasher->hashPassword($vendorSecurity, $plainPassword);
        $vendorSecurity->setPassword($hashedPassword);

        $vendorEnUS = new VendorEnUS();
        $vendorEnUS->setFirstTitle($name);

        $vendor->setVendorSecurity($vendorSecurity);
        $vendor->setVendorEnUS($vendorEnUS);


        $this->entityManager->persist($vendor);
        $this->entityManager->persist($vendorSecurity);
        $this->entityManager->persist($vendorEnUS);

        $this->entityManager->flush();

        $this->io->success('User created successfully');

        return Command::SUCCESS;
    }


    private function validateUserData($username, $plainPassword, $email, $firstTitle): void
    {
        if (empty($username) || empty($plainPassword) || empty($email) || empty($firstTitle)) {
            throw new RuntimeException('All fields are required.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Invalid email format.');
        }

        $vendorRepository = $this->entityManager->getRepository(VendorSecurity::class);

        $existingVendor = $vendorRepository->findOneByEmail($email);

        if ($existingVendor) {
            throw new RuntimeException(sprintf('A vendor with email "%s" already exists.', $email));
        }

        $this->validatePassword($plainPassword);
    }


    private function getCommandHelp(): string
    {
        return <<<HELP
        The <info>%command.name%</info> command creates new users and saves them in the database:

          <info>php %command.full_name%</info> <comment>username password email fullName</comment>

        If you omit any of the required arguments, the command will ask you to
        provide the missing values:

          # command will ask you for the email and full name
          <info>php %command.full_name%</info> <comment>username password</comment>
    HELP;
    }

    private function validatePassword($plainPassword): void
    {
        $length = strlen($plainPassword);

        if ($length < 8) {
            throw new RuntimeException('The password must be at least 8 characters long.');
        }

        if (!preg_match('/[A-Z]/', $plainPassword)) {
            throw new RuntimeException('The password must include at least one uppercase letter.');
        }

        if (!preg_match('/[a-z]/', $plainPassword)) {
            throw new RuntimeException('The password must include at least one lowercase letter.');
        }

        if (!preg_match('/[0-9]/', $plainPassword)) {
            throw new RuntimeException('The password must include at least one number.');
        }

        if (!preg_match('/[\W]/', $plainPassword)) {
            throw new RuntimeException('The password must include at least one special character.');
        }
    }

    /**
     * @throws \Exception
     */
    private function generatePassword(): string
    {
        return bin2hex(random_bytes(12 / 2));
    }
}
