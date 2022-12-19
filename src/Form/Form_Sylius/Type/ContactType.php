<?php


namespace App\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'ui.email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'contact.email.not_blank',
                    ]),
                    new Email([
                        'message' => 'contact.email.invalid',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'ui.message',
                'constraints' => [
                    new NotBlank([
                        'message' => 'contact.message.not_blank',
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
                $email = $options['email'];
                if (null === $email) {
                    return;
                }

                $data = $event->getData();
                $data['email'] = $email;

                $event->setData($data);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'email' => null,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'contact';
    }
}
