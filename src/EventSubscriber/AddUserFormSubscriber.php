<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AddUserFormSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly string $entryType = 'Type')
    {
    }

    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string', FormEvents::SUBMIT => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::SUBMIT => 'submit',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $form = $event->getForm();
        $form->add('user', $this->entryType, ['constraints' => [new Valid()]]);
        $form->add('createUser', CheckboxType::class, [
            'label' => 'ui.customer_can_login_to_the_store',
            'required' => false,
            'mapped' => false,
        ]);
    }

    public function submit(FormEvent $event): void
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data->getUser()->getId() && null === $form->get('createUser')->getViewData()) {
            $data->setUser(null);
            $event->setData($data);

            $form->remove('user');
            $form->add('user', $this->entryType, ['constraints' => [new Valid()]]);
        }
    }
}
