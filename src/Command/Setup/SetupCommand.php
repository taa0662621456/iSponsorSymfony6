<?php

namespace App\Command\Setup;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class SetupCommand extends Command
{
    protected static $defaultName = 'setup';

    protected function configure(): void
    {
        $this
            ->setDescription('Setup maintenance configuration.')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command allows currency, locale, vendor(us a super admin) to configure basic data.
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Setup a currency and locale',
            '============',
            '',
        ]);

        //$currency = $this->getApplication()->get('setup.currency')->setup($input, $output, $this->getHelper('question'), null);
        $locale = $this->getApplication()->get('setup.locale')->flushEntity($input, $output, $this->getHelper('question'));

        $output->writeln([
            'Setup a administrative account',
            '============',
            '',
        ]);

        //$this->getApplication()->get('setup.vendor')->flushEntity($locale, $currency, $this->getHelper('question'));

        $this->flushEntity($input, $output, $locale->getCode());

        return 0;
    }

    public function vendorEntity(InputInterface $input, OutputInterface $output, string $localeCode, ObjectManager $manager)
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $outputStyle->writeln('Create VendorEntity.');

        $vendor = new Vendor();

        /*
        $vendorFactory = $this->get('factory.vendor');

        try {
            $vendor = $this->configureVendor($vendorFactory->create(), $input, $output);
        } catch (\InvalidArgumentException) {
            return;
        }
         */

        $vendor->setLocale($localeCode);

        $manager->persist($vendor);
    }

    public function vendorEnUsEntity(InputInterface $input, OutputInterface $output, string $localeCode, ObjectManager $manager)
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $outputStyle->writeln('Create VendorEnUsEntity.');

        $vendorEnUs = new VendorEnUS();

//        $vendorEnUsFactory = $this->getApplication()->get('factory.vendorEnUs');
//
//        try {
//            $vendorEnUs = $this->configureVendor($vendorEnUsFactory->create(), $input, $output);
//        } catch (\InvalidArgumentException) {
//            return;
//        }

        $manager->persist($vendorEnUs);

    }

    public function vendorSecurityEntity(InputInterface $input, OutputInterface $output, string $localeCode, ObjectManager $manager)
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $outputStyle->writeln('Create VendorSecurityEntity.');

        $vendorSecurity = new VendorSecurity();

        /*
        $vendorSecurityFactory = $this->getApplication()->get('factory.vendorSecurity');

        try {
        $vendorSecurity = $this->configureVendor($vendorSecurityFactory->create(), $input, $output);
        } catch (\InvalidArgumentException) {
        return;
        }
         */

        $vendorSecurity->setEmail($this->email($input, $output));
        $vendorSecurity->setUsername($this->usernameQuestion($input, $output));
        $vendorSecurity->setPlainPassword($this->password($input, $output));

        $manager->persist($vendorSecurity);

    }

    private function flushEntity(InputInterface $input, OutputInterface $output, ObjectManager $manager): void
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $manager->flush();

        $outputStyle->writeln('<info>Administrator account successfully registered.</info>');
        $outputStyle->newLine();

    }

    public function usernameQuestion(InputInterface $input, OutputInterface $output, string $username = 'example'):string
    {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $vendorSecurityRepository = $this->getApplication()->get('repository.vendorSecurity');

        do {
            $question = new Question('Username (press enter to use example): ', $username);
            $username = $questionHelper->ask($input, $output, $question);
            $exists = null !== $vendorSecurityRepository->findOneBy(['username' => $username]);

            if ($exists) {
                $output->writeln('<error>Username is already in use!</error>');
            }
        } while ($exists);

        return $username;

    }
    private function emailQuestion(): Question
    {

        return (new Question('Input administrative account e-mail please: '))
            ->setValidator(
            /**
             * @param mixed $value
             * @return string
             */
                function (mixed $value): string {
                    /** @var ConstraintViolationListInterface $errors */
                    $validator = $this->getApplication()->get('validator');
                    $errors = $validator((string)$value, [new Email(), new NotBlank()]);
                    foreach ($errors as $error) {
                        throw new \DomainException((string)$error->getMessage());
                    }

                    return $value;
                },
            )
            ->setMaxAttempts(3);
    }

    private function password(InputInterface $input, OutputInterface $output): string
    {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $validator = $this->passwordValidator();

        do {
            $passwordQuestion = $this->createPasswordQuestion('Choose password:', $validator);
            $confirmPasswordQuestion = $this->createPasswordQuestion('Confirm password:', $validator);

            $password = $questionHelper->ask($input, $output, $passwordQuestion);
            $repeatedPassword = $questionHelper->ask($input, $output, $confirmPasswordQuestion);

            if ($repeatedPassword !== $password) {
                $output->writeln('<error>Passwords do not match!</error>');
            }
        } while ($repeatedPassword !== $password);

        return $password;
    }

    private function createPasswordQuestion(string $message, \Closure $validator): Question
    {
        return (new Question($message))
            ->setValidator($validator)
            ->setMaxAttempts(3)
            ->setHidden(true)
            ->setHiddenFallback(false);
    }

    private function email(InputInterface $input, OutputInterface $output): string
    {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $vendorSecurityRepository = $this->getApplication()->get('repository.vendorSecurity');

        do {
            $question = $this->emailQuestion();
            $email = $questionHelper->ask($input, $output, $question);
            $exists = null !== $vendorSecurityRepository->findOneByEmail($email);

            if ($exists) {
                $output->writeln('<error>E-Mail is already in use!</error>');
            }
        } while ($exists);

        return $email;
    }

    private function passwordValidator(): \Closure
    {
        return
            /**
             * @param mixed $value
             * @return string
             */
            function (mixed $value): string {
                /** @var ConstraintViolationListInterface $errors */
                $errors = $this->getApplication()->get('validator');
                foreach ($errors as $error) {
                    throw new \DomainException((string)$error->getMessage());
                }

                return $value;
            };
    }

    /*
    private function getVendorSecurityRepository(): VendorRepository
    {
        return $this->getApplication()->get('repository.vendorSecurity');
    }
     */

    /*
    public function exampleVendorCheck(InputInterface $input, OutputInterface $output): int
    {
        $vendorSecurityRepository = $this->getVendorSecurityRepository();

        if ($input->getOption('no-interaction')) {
            Assert::null($vendorSecurityRepository->findOneByEmail('example@example.com'), 'Такой вендор уже есть');
            return 1;
        }
        return 0;
    }
     */


}
