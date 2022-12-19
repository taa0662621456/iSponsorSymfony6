<?php


namespace App\ProductBundle\Form\Type;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductAssociationsType extends AbstractType
{
    public function __construct(
        private RepositoryInterface $productAssociationTypeRepository,
        private DataTransformerInterface $productsToProductAssociationsTransformer,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->productsToProductAssociationsTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->productAssociationTypeRepository->findAll(),
            'entry_type' => TextType::class,
            'entry_name' => fn (ProductAssociationTypeInterface $productAssociationType) => $productAssociationType->getCode(),
            'entry_options' => fn (ProductAssociationTypeInterface $productAssociationType) => [
                'label' => $productAssociationType->getName(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'product_associations';
    }
}
