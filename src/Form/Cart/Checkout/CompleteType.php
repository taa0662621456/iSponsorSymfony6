<?php

namespace App\Form\Cart\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class CompleteType extends AbstractType
{
    protected string $dataClass;

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
        $builder->add('notes', TextareaType::class, [
            'label' => 'form.notes',
            'required' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'checkout_complete';
    }
}
