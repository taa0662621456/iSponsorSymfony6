<?php


namespace App\CoreBundle\EventListener;



use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

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
