<?php


namespace App\AddressingBundle\Form\Type;


use Symfony\Component\OptionsResolver\OptionsResolver;

final class ZoneMemberType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('code', $options['entry_type'], array_merge($options['entry_options'], ['required' => true]));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('entry_type')
            ->setDefaults([
                'entry_options' => [],
                'placeholder' => 'form.zone_member.select',
                'data_class' => $this->dataClass,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'zone_member';
    }
}
