<?php
namespace App\EventListener;

use App\DataFixtureInterface\GroupedFixtureInterface;
use Doctrine\Common\EventSubscriber;

class GroupedFixtureExecutorListener implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            LoadEvent::class => 'onFixtureLoad',
        ];
    }

    public function onFixtureLoad(LoadEvent $event): void
    {
        $fixtures = $event->getFixtures();

        usort($fixtures, function ($a, $b) {
            if ($a instanceof GroupedFixtureInterface && $b instanceof GroupedFixtureInterface) {
                $cmpGroup = strcmp($a::getGroup(), $b::getGroup());
                if ($cmpGroup !== 0) {
                    return $cmpGroup;
                }
                return $a::getPriority() <=> $b::getPriority();
            }
            return 0;
        });

        $event->setFixtures($fixtures);
    }
}
