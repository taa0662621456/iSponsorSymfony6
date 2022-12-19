<?php


namespace App\AttributeBundle\Form\Type\AttributeType\Configuration;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SelectAttributeValueTranslationsType extends AbstractType
{
    /** @var string[] */
    private array $definedLocalesCodes;

    private string $defaultLocaleCode;

    public function __construct(TranslationLocaleProviderInterface $localeProvider)
    {
        $this->definedLocalesCodes = $localeProvider->getDefinedLocalesCodes();
        $this->defaultLocaleCode = $localeProvider->getDefaultLocaleCode();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->definedLocalesCodes,
            'entry_name' => fn (string $localeCode): string => $localeCode,
            'entry_options' => fn (string $localeCode): array => [
                'required' => $localeCode === $this->defaultLocaleCode,
            ],
        ]);
    }

    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'select_attribute_value_translations';
    }
}
