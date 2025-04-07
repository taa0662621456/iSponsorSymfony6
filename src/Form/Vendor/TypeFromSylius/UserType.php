<?php

namespace App\Form\Vendor\TypeFromSylius;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * @property array $validationGroups
 * @property $dataClass
 */
abstract class UserType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'form.user.username',
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.user.email',
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'form.user.password.label',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'form.user.enabled',
                'required' => false,
            ])
            ->add('verifiedAt', CheckboxType::class, [
                'label' => 'form.user.verified',
                'required' => false,
            ]);

        $builder->get('verifiedAt')->addModelTransformer(new UserVerifiedAtToBooleanTransformer(), true);

        $builder->addEventListener(FormEvents::POST_SET_DATA, static function (FormEvent $event) {
            /** @var ShopUser|null $data */
            $data = $event->getData();
            if (null === $data) {
                return;
            }

            if ($data->isVerified()) {
                $event->getForm()->add('verifiedAt', CheckboxType::class, [
                    'label' => 'form.user.verified',
                    'required' => false,
                    'disabled' => true,
                    'data' => true,
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => $this->dataClass,
                'validation_groups' => function (FormInterface $form): array {
                    $data = $form->getData();
                    if ($data && !$data->getId()) {
                        $this->validationGroups[] = 'user_create';
                    }

                    return $this->validationGroups;
                },
            ]);
    }
}
