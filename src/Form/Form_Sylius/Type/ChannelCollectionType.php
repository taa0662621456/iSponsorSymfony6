<?php


namespace App\CoreBundle\Form\Type;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelCollectionType extends AbstractType
{
    public function __construct(private ChannelRepositoryInterface $channelRepository)
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->channelRepository->findAll(),
            'entry_name' => fn (ChannelInterface $channel) => $channel->getCode(),
            'error_bubbling' => false,
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $children = $form->all();

        $view->vars['channels_errors_count'] = array_combine(
            array_keys($children),
            array_map(
                static fn (FormInterface $child): int => $child->getErrors(true)->count(),
                $children,
            ),
        );
    }

    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'channel_collection';
    }
}
