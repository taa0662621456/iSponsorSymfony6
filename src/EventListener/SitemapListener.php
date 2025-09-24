<?php

namespace App\EventListener;

use App\Service\RequestDispatcher;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\RouterInterface;
use function in_array;

class SitemapListener implements EventSubscriberInterface
{
    public function __construct(private readonly EntityManagerInterface $doctrine, private readonly UrlGeneratorInterface $router, private readonly RequestDispatcher $requestDispatcher)
    {
    }

    /**
     * @inheritdoc
     */
    #[ArrayShape([SitemapPopulateEvent::ON_SITEMAP_POPULATE => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'populate',
        ];
    }

    public function populate(SitemapPopulateEvent $event, RequestDispatcher $requestDispatcher): void
    {
        if (in_array($event->getSection(), [$requestDispatcher->object(), null], true)) {
            $this->entityPage($event->getUrlContainer());
        }
        if (in_array($event->getSection(), [$requestDispatcher->object(), null], true)) {
            $this->entities($event->getUrlContainer());
        }

        $this->entityPage($event->getUrlContainer());
    }

    public function entityPage(UrlContainerInterface $url, UrlGeneratorInterface $router): void
    {
        $object = $this->requestDispatcher->object();
        $entities = $this->doctrine->getRepository($object)->findAll();
# v1
//        foreach ($pages as $page) {
//            $url->addUrl(
//                $this->url(
//                    'page',
//                    ['slug' => $page->getSlug()],
//                ),
//                'default'
//            );
//        }

# v2
//        foreach ($projects as $project) {
//            $url->addUrl(
//                new UrlConcrete(
//                    $router->generate(
//                        'product_show_slug',
//                        ['slug' => $project->getSlug()],
//                        UrlGeneratorInterface::ABSOLUTE_URL
//                    )
//                ),
//                'project'
//            );
//        }

    }

    private function entities(UrlContainerInterface $urlContainer): void
    {
        $object = $this->requestDispatcher->object();
        $entities = $this->doctrine->getRepository($object)->findAll();

        /** @var $entity */
        foreach ($entities as $entity) {
            $url = $this->url(
                $entities . 'show_slug',
                ['slug' => $entity->getSlug()]
            );

# TODO: обработка медиаАттачмнтов
//            if (count($entity->getImages()) > 0) {
//                $url = new GoogleImageUrlDecorator($url);
//                foreach ($entity->getImages() as $idx => $image) {
//                    $url->addImage(
//                        new GoogleImage($image, sprintf('%s - %d', $entity->getTitle(), $idx + 1))
//                    );
//                }
//            }

//            if ($entity->getVideo() !== null) {
//                parse_str(parse_url($entity->getVideo(), PHP_URL_QUERY), $parameters);
//                $url = new GoogleVideoUrlDecorator($url);
//                $url->addVideo(
//                    $video = new GoogleVideo(
//                        sprintf('https://img.youtube.com/vi/%s/0.jpg', $parameters['v']),
//                        $entity->getTitle(),
//                        $entity->getTitle(),
//                        ['content_location' => $entity->getVideo()]
//                    )
//                );
//            }

            $urlContainer->addUrl($url, $object);
        }
    }

    private function url(string $route, array $parameters = []): UrlConcrete
    {
        $object = $this->requestDispatcher->object();
        $parameters = [];
        return new UrlConcrete(
            $this->router->generate($object, $parameters, UrlGeneratorInterface::ABSOLUTE_URL)
        );
    }
}