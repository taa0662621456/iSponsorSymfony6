<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class GrantPermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('permission', ChoiceType::class, [
            'choices'  => [
                'View'   => 'VIEW',
                'Edit'   => 'EDIT',
                'Delete' => 'DELETE',
                'Cancel' => 'CANCEL',
                'Refund' => 'REFUND',
                'Pay'    => 'PAY',
            ],
            'label' => 'Choose Permission',
            'required' => true,
        ]);
    }
}
