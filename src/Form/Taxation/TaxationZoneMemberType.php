<?php

namespace App\Form\Taxation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxationZoneMemberType extends AbstractType
{
    protected string $dataClass = 'data_class';

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string   $dataClass        FQCN
     * @param string[] $validationGroups
     */
    public function __construct(string $dataClass = 'data_class', array $validationGroups = [])
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

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
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'zone_member';
    }
}
