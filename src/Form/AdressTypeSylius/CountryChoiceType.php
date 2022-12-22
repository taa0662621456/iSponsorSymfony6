<?php


namespace App\AddressingBundle\Form\Type;



use Composer\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CountryChoiceType extends AbstractType
{
    public function __construct(private RepositoryInterface $countryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choice_filter' => null,
                'choices' => function (Options $options): iterable {
                    if ($options['enabled'] === true) {
                        return  $this->countryRepository->findBy(['enabled' => $options['enabled']]);
                    }

                    return $this->countryRepository->findAll();
                },
                'choice_value' => 'code',
                'choice_label' => 'name',
                'choice_translation_domain' => false,
                'enabled' => true,
                'label' => 'form.address.country',
                'placeholder' => 'form.country.select',
            ])
            ->setAllowedTypes('choice_filter', ['null', 'callable'])
            ->setNormalizer('choices', static function (Options $options, array $countries): array {
                if ($options['choice_filter']) {
                    $countries = array_filter($countries, $options['choice_filter']);
                }

                usort($countries, static fn (CountryInterface $firstCountry, CountryInterface $secondCountry): int => $firstCountry->getName() <=> $secondCountry->getName());

                return $countries;
            })
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'country_choice';
    }
}
