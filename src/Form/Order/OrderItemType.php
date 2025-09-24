<?php

namespace App\Form\Order;

use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OrderItemType
{
    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];
    /**
     * @param string $dataClass FQCN
     * @param string[] $validationGroups
     */
    public function __construct(
        string                               $dataClass,
        array                                $validationGroups,
        private readonly DataMapperInterface $dataMapper,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'attr' => ['min' => 1],
                'label' => 'ui.quantity',
            ])
            ->setDataMapper($this->dataMapper)
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'order_item';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'validation_groups' => $this->validationGroups,
        ]);
    }
}