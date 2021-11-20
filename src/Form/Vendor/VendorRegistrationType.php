<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorRegistrationType extends AbstractType
{
    private string $token;

    /**
     * VendorLoginType constructor.
     */
    public function __construct(string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
			->add('vendorSecurity', VendorSecurityType::class, [
			    'label' => 'vendor.registration'
            ])
			->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.label.registration',
                'attr'  => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3([
                    'message' => 'There were problems with your captcha. Please try again or contact with support and provide following code(s): {{ errorCodes }}',
                    'messageMissingValue' => 'karser_recaptcha3.message_missing_value',
                    ]),
                'action_name' => 'registration',
                'script_nonce_csp' => 'sdfsdfsdf',
            ])
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'name' => '_csrf_token',
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => Vendor::class,
            'trim' => true,
            'csrf_protection'    => true,
            'csrf_field_name'    => '_csrf_token',
            'csrf_token_id'      => $this->token,
            'translation_domain' => 'vendor',
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}
