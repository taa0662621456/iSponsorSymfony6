<?php

	namespace App\Form\Menu;

    use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
    use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class MenuItemType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder
				->add('menuItemTitle')
				->add('menuItemPath')
				->add('menuItemDisplayType')
				->add('menuItemPublished')
				->add('role')
				->add('home')
				->add('locale')
				->add('uuid')
				->add('slug')
				->add('createdAt')
				->add('createdBy')
				->add('modifiedOn')
				->add('modifiedBy')
				->add('lockedOn')
				->add('lockedBy')
				->add('version')
				->add('parent')
			;
		}

		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults(
				[
					'data_class' => MenuItem::class,
				]
			);
		}
	}
