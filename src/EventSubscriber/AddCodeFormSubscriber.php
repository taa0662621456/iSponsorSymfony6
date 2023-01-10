<?php

namespace App\EventSubscriber;

use App\Interface\CodeAwareInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddCodeFormSubscriber implements EventSubscriberInterface
{
    private string $type;

    private array $options;

    public function __construct(?string $type = null, array $options = [])
    {
        $this->type = $type ?? TextType::class;
        $this->options = $options;
    }

    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $resource = $event->getData();
        $disabled = false;

        if ($resource instanceof CodeAwareInterface) {
            $disabled = null !== $resource->getCode();
        } elseif (null !== $resource) {
            throw new UnexpectedTypeException($resource, CodeAwareInterface::class);
        }

        $form = $event->getForm();
        $form->add('code', $this->type, array_merge(
            ['label' => 'ui.code'],
            $this->options,
            ['disabled' => $disabled],
        ));
    }
}
