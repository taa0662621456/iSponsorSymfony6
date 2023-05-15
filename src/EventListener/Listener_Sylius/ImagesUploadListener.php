<?php


namespace App\EventListener\Listener_Sylius;



use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class ImagesUploadListener
{
    public function __construct(private ImageUploaderInterface $uploader)
    {
    }

    public function uploadImages(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ImagesAwareInterface::class);

        $this->uploadSubjectImages($subject);
    }

    private function uploadSubjectImages(ImagesAwareInterface $subject): void
    {
        $images = $subject->getImages();
        foreach ($images as $image) {
            if ($image->hasFile()) {
                $this->uploader->upload($image);
            }

            // Upload failed? Let's remove that image.
            if (null === $image->getPath()) {
                $images->removeElement($image);
            }
        }
    }
}
