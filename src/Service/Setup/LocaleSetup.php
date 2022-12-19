<?php

namespace App\Service\Setup;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Languages;

final class LocaleSetup implements LocaleSetupInterface
{
    private string $locale;

    public function __construct(private readonly RepositoryInterface $localeRepository, private readonly FactoryInterface $localeFactory, string $locale)
    {
        $this->locale = trim($locale);
    }

    public function setup(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): LocaleInterface
    {
        $code = $this->getLanguageCodeFromUser($input, $output, $questionHelper);

        $output->writeln(sprintf('Adding <info>%s</info> locale.', $code));

        if ($this->locale !== $code) {
            $output->writeln('<info>You may also need to add this locale into config/services.yaml configuration.</info>');
        }

        /** @var LocaleInterface|null $existingLocale */
        $existingLocale = $this->localeRepository->findOneBy(['code' => $code]);
        if (null !== $existingLocale) {
            return $existingLocale;
        }

        /** @var LocaleInterface $locale */
        $locale = $this->localeFactory->createNew();
        $locale->setCode($code);

        $this->localeRepository->add($locale);

        return $locale;
    }

    private function getLanguageCodeFromUser(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $code = $this->getNewLanguageCode($input, $output, $questionHelper);
        $name = $this->getLanguageName($code);

        while (null === $name) {
            $output->writeln(
                sprintf('<comment>Language with code <info>%s</info> could not be resolved.</comment>', $code),
            );

            $code = $this->getNewLanguageCode($input, $output, $questionHelper);
            $name = $this->getLanguageName($code);
        }

        $output->writeln(sprintf('Adding <info>%s</info> Language.', $name));

        return $code;
    }

    private function getNewLanguageCode(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $question = new Question('Language (press enter to use ' . $this->locale . '): ', $this->locale);

        return trim($questionHelper->ask($input, $output, $question));
    }

    private function getLanguageName(string $code): ?string
    {
        $language = $code;
        $region = null;

        if (count(explode('_', $code, 2)) === 2) {
            [$language, $region] = explode('_', $code, 2);
        }

        try {
            return Languages::getName($language, $region);
        } catch (MissingResourceException) {
            return null;
        }
    }
}
