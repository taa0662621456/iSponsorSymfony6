<?php


namespace App\CoreBundle\Form\Type\Promotion\Rule;


use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class CustomerGroupConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('group_code', CustomerGroupCodeChoiceType::class, [
                'label' => 'form.promotion_rule.customer_group.group',
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Type(['type' => 'string', 'groups' => ['isponsor']]),
                ],
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_customer_group_configuration';
    }
}
