<?php

namespace App\Form\Shipment\TypeSylius;

use Symfony\Component\Form\AbstractType;
use App\Dto\Shipment\ShipmentCategoryDTO;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\Shipment\ShipmentCategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;

final class ShipmentCategoryChoiceType extends AbstractType
{
    private ShipmentCategoryRepository $shipmentCategoryRepository;

    public function __construct(ShipmentCategoryRepository $shipmentCategoryRepository)
    {
        $this->shipmentCategoryRepository = $shipmentCategoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => fn (Options $options) => $this->shipmentCategoryRepository->findAll(),
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'data_class' => ShipmentCategoryDTO::class,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_category_choice';
    }
}
