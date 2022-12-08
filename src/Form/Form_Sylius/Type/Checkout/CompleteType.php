<?php


namespace App\CoreBundle\Form\Type\Checkout;



final class CompleteType extends AbstractResourceType
{
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
