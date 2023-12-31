<?php

namespace App\EventListener\Listener_Sylius;

use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ImageUploadListener
{
    public function __construct(private ImageUploaderInterface $uploader)
    {
    }

    public function uploadImage(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ImageAwareInterface::class);

        if (null !== $subject->getImage()) {
            $this->uploader->upload($subject->getImage());
        }
    }
}
