<?php

namespace App\Form\Local;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class LocaleType extends AbstractType
{
    //    protected string $dataClass;
    //
    //    /** @var string[] */
    //    protected array $validationGroups = [];
    //
    //    /**
    //     * @param string $dataClass FQCN
    //     * @param string[] $validationGroups
    //     */
    //    public function __construct(string $dataClass, array $validationGroups = [])
    //    {
    //        $this->dataClass = $dataClass;
    //        $this->validationGroups = $validationGroups;
    //    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', \Symfony\Component\Form\Extension\Core\Type\LocaleType::class, [
                'label' => 'form.locale.name',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'locale';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'validation_groups' => $this->validationGroups,
        ]);
    }
}
