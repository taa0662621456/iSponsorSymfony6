<?php

namespace App\Form\Shipment\TypeSylius;

use App\EntityInterface\Shipment\ShipmentMethodInterface;
use App\EntityInterface\Shipment\ShipmentSubjectInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Ramsey\Uuid\Math\CalculatorInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;

/**
 * @property $calculators
 * @property $repository
 * @property $shippingMethodsResolver
 */
final class ShippingMethodChoiceType extends AbstractType
{
    public function __construct(
        /*        private readonly ShipmentMethodResolverInterface $shippingMethodsResolver,
                private readonly ServiceRegistryInterface $calculators,
                private readonly RepositoryInterface $repository,*/
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => function (Options $options) {
                    if (isset($options['subject']) && $this->shippingMethodsResolver->supports($options['subject'])) {
                        return $this->shippingMethodsResolver->getSupportedMethods($options['subject']);
                    }

                    return $this->repository->findAll();
                },
                'choice_value' => 'code',
                'choice_label' => 'name',
                'choice_translation_domain' => false,
            ])
            ->setDefined([
                'subject',
            ])
            ->setAllowedTypes('subject', ShipmentSubjectInterface::class);
    }

    /**
     * @psalm-suppress MissingPropertyType
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        if (!isset($options['subject'])) {
            return;
        }

        $subject = $options['subject'];
        $shippingCosts = [];

        foreach ($view->vars['choices'] as $choiceView) {
            $method = $choiceView->data;

            if (!$method instanceof ShipmentMethodInterface) {
                throw new UnexpectedTypeException($method, ShipmentMethodInterface::class);
            }

            /** @var CalculatorInterface $calculator */
            $calculator = $this->calculators->get($method->getCalculator());
            $shippingCosts[$choiceView->value] = $calculator->calculate($subject, $method->getConfiguration());
        }

        $view->vars['shipping_costs'] = $shippingCosts;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_choice';
    }
}
