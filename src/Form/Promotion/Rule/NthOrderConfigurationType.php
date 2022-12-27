<?php


namespace App\Form\Promotion\Rule;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class NthOrderConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nth', IntegerType::class, [
                'label' => 'form.promotion_rule.nth_order_configuration.nth',
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Type(['type' => 'numeric', 'groups' => ['isponsor']]),
                ],
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_nth_order_configuration';
    }
}
