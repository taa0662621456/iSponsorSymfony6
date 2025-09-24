<?php

namespace App\Form\Product\AttributeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use App\EntityInterface\Locale\LocaleInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use function count;
use function is_array;

final class SelectAttributeType extends AbstractType
{
    public const TYPE = 'select';

    private string $defaultLocaleCode;

    public function __construct(LocaleInterface $locale)
    {
        $this->defaultLocaleCode = $locale->getDefaultLocaleCode();
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (is_array($options['configuration'])
            && isset($options['configuration']['multiple'])
            && !$options['configuration']['multiple']) {
            $builder->addModelTransformer(new CallbackTransformer(
                function ($array) {
                    if (is_array($array) && count($array) > 0) {
                        return $array[0];
                    }
                },
                function ($string): array {
                    if (null !== $string) {
                        return [$string];
                    }

                    return [];
                },
            ));
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('configuration')
            ->setDefault('placeholder', 'form.attribute_type_configuration.select.choose')
            ->setDefault('locale_code', $this->defaultLocaleCode)
            ->setNormalizer('choices', function (Options $options) {
                if (is_array($options['configuration'])
                    && isset($options['configuration']['choices'])
                    && is_array($options['configuration']['choices'])) {
                    $choices = [];
                    $localeCode = $options['locale_code'] ?? $this->defaultLocaleCode;

                    foreach ($options['configuration']['choices'] as $key => $choice) {
                        if (isset($choice[$localeCode]) && '' !== $choice[$localeCode] && null !== $choice[$localeCode]) {
                            $choices[$key] = $choice[$localeCode];

                            continue;
                        }

                        if (false === isset($choice[$this->defaultLocaleCode]) || '' === $choice[$this->defaultLocaleCode]) {
                            continue;
                        }

                        $choices[$key] = $choice[$this->defaultLocaleCode];
                    }

                    $choices = array_flip($choices);
                    ksort($choices);

                    return $choices;
                }

                return [];
            })
            ->setNormalizer('multiple', function (Options $options): bool {
                if (is_array($options['configuration']) && isset($options['configuration']['multiple'])) {
                    return $options['configuration']['multiple'];
                }

                return false;
            });
    }

    public function getBlockPrefix(): string
    {
        return 'attribute_type_select';
    }
}