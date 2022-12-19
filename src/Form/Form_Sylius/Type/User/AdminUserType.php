<?php


namespace App\CoreBundle\Form\Type\User;



final class AdminUserType extends UserType
{
    public function __construct(string $dataClass, array $validationGroups = [], private ?string $fallbackLocale = null)
    {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
                'label' => 'form.user.first_name',
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'label' => 'form.user.last_name',
            ])
            ->add('localeCode', LocaleType::class, $this->provideLocaleCodeOptions())
            ->add('avatar', AvatarImageType::class, [
                'label' => 'ui.avatar',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'admin_user';
    }

    private function provideLocaleCodeOptions(): array
    {
        $localeCodeOptions = [
            'label' => 'ui.locale',
            'placeholder' => null,
        ];

        if ($this->fallbackLocale !== null) {
            $localeCodeOptions['preferred_choices'] = [$this->fallbackLocale];
        }

        return $localeCodeOptions;
    }
}
