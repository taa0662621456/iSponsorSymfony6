<?php


namespace App\Form\Forgot;


use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorSecurity;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgotType extends AbstractType
{
    private string $token;

    /**
     * SecurityForgotEmailType constructor.
     */
    public function __construct(string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vendorSecurity', $options['forgot_сredential_type'], [
                'label' => 'security.forgot'
            ])
            ->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.label.forgot',
                'attr'  => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3([
                    'message' => 'There were problems with your captcha. Please try again or contact with support and provide following code(s): {{ errorCodes }}',
                    'messageMissingValue' => 'captcha.missing.value',
                ]),
                'action_name' => 'registration',
                # 'script_nonce_csp' => $nonceCSP,
            ])
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'name' => '_csrf_token',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendor::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => $this->token,
            'translation_domain' => 'security',
            'validation_groups' => false,
            'forgot_сredential_type' => 'App\Form\Forgot\ForgotEmailType', //TODO: добавить парамерт в app и дефолтное значение
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}
