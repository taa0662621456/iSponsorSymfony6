<?php

namespace App\Form\Currency;

use App\Dto\Currency\CurrencyTypeDTO;
use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\RepositoryInterface\Currency\CurrencyTypeRepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType as SymfonyCurrencyType;

final class CurrencyType extends AbstractType
{
    /** @var string[] */
    protected array $validationGroup = [];

    public function __construct(private CurrencyTypeRepositoryInterface $currencyTypeRepository, array $validationGroup = [])
    {
        $this->validationGroup = $validationGroup;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => $this->validationGroup,
            'data_class' => CurrencyTypeDTO::class,
        ]);
    }

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber(SymfonyCurrencyType::class, [
                'label' => 'form.currency.code',
            ]));
    }

    public function getBlockPrefix(): string
    {
        return 'currency';
    }
}
