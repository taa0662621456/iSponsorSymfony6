<?php


namespace App\Form\Security;


use App\Entity\Vendor\VendorSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SecurityForgotPhoneType extends AbstractType
{
    private string $token;

    /**
     * SecurityForgotPasswordType constructor.
     */
    public function __construct(string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                    'invalid_message' => 'The email address is invalid.',
                    'label'           => 'vendor.label.email',
                    'label_attr'      => [
                        'class' => 'sr-only',
                        'value' => 'last_username'
                    ],
                    'required'        => true,
                    'constraints'     => [
                        new NotBlank([
                            'message' => 'Пожалуйста введите email Вашей учетной записи',
                        ]),
                        new Length([
                            'min' => 5,
                            'minMessage' => 'Your email should be at least {{ limit }} characters',
                            'max' => 64,
                        ]),
                    ],
                    'attr'            => [
                        'id'          => 'email',
                        'name'        => '_email',
                        'class'       => '',
                        'placeholder' => 'vendor.placeholder.email',
                        'tabindex'    => '101',
                        'required'    => null
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
//            'data_class'         => VendorSecurity::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => $this->token,
            'translation_domain' => 'security',
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}
