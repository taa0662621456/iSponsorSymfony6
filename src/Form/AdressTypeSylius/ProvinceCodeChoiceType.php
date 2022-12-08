<?php


namespace App\AddressingBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class ProvinceCodeChoiceType extends AbstractType
{
    public function __construct(private RepositoryInterface $provinceRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->provinceRepository, 'code')));
    }

    public function getParent(): string
    {
        return ProvinceChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'province_code_choice';
    }
}
