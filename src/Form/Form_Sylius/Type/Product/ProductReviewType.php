<?php


namespace App\CoreBundle\Form\Type\Product;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;
use Webmozart\Assert\Assert;

final class ProductReviewType extends ReviewType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $form = $event->getForm();
            $review = $event->getData();

            Assert::isInstanceOf($review, ReviewInterface::class);

            if (null === $review->getAuthor()) {
                $form->add('author', CustomerGuestType::class, ['constraints' => [new Valid()]]);
            }
        });
    }

    public function getBlockPrefix(): string
    {
        return 'product_review';
    }
}
