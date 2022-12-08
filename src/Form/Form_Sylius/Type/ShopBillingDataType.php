<?php


namespace App\CoreBundle\Form\Type;


use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShopBillingDataType extends AbstractType
{
    public function __construct(private string $dataClass)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxId', TextType::class, [
                'label' => 'form.channel.billing_data.tax_id',
                'required' => false,
            ])
            ->add('company', TextType::class, [
                'required' => false,
                'label' => 'form.channel.billing_data.company',
            ])
            ->add('countryCode', CountryCodeChoiceType::class, [
                'label' => 'form.channel.billing_data.country',
                'enabled' => true,
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => 'form.channel.billing_data.street',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'form.channel.billing_data.city',
                'required' => false,
            ])
            ->add('postcode', TextType::class, [
                'label' => 'form.channel.billing_data.postcode',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', $this->dataClass);
    }
}
