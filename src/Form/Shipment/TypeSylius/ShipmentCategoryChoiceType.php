<?php


namespace App\Form\Shipment\TypeSylius;

use App\Dto\Shipment\ShipmentCategoryDTO;
use App\RepositoryInterface\Shipment\ShipmentCategoryRepositoryInterface;
use App\Repository\Shipment\ShipmentCategoryRepository;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
