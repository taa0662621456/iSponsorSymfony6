<?php


namespace App\EventListener\Listener_Sylius;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Imagine\Image\ImageInterface;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;



/**
 * @internal
 */
final class ImagesRemoveListener
{
    /** @var string[] */
    private array $imagesToDelete = [];

    public function __construct(
        private readonly ImageUploaderInterface $imageUploader,
        private readonly CacheManager           $cacheManager,
        private readonly FilterManager          $filterManager,
    ) {
    }

    public function onFlush(OnFlushEventArgs $event): void
    {
        foreach ($event->getObjectManager()->getUnitOfWork()->getScheduledEntityDeletions() as $entityDeletion) {
            if (!$entityDeletion instanceof ImageInterface) {
                continue;
            }

            $path = $entityDeletion->getPath();

            if (null === $path) {
                continue;
            }

            if (!in_array($path, $this->imagesToDelete, true)) {
                $this->imagesToDelete[] = $path;
            }
        }
    }

    public function postFlush(PostFlushEventArgs $event): void
    {
        foreach ($this->imagesToDelete as $key => $imagePath) {
            $this->imageUploader->remove($imagePath);
            $this->cacheManager->remove($imagePath, array_keys($this->filterManager->getFilterConfiguration()->all()));
            unset($this->imagesToDelete[$key]);
        }
    }
}
