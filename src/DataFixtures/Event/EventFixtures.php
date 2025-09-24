<?php

namespace App\DataFixtures\Event;

use App\Entity\Event\Event;
use App\Entity\Event\EventCategory;
use App\Entity\Event\EventMember;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class EventFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new EventCategory();
        $category->setName('Conference');
        $manager->persist($category);

        $event = new Event();
        $event->setTitle('Tech Summit');
        $event->setCategory($category);
        $manager->persist($event);

        $member = new EventMember();
        $member->setName('John Doe');
        $member->setEvent($event);
        $manager->persist($member);

        $this->addReference('event_category_conf', $category);
        $this->addReference('event_techsummit', $event);
        $this->addReference('event_member_john', $member);

        $manager->flush();
    }

    public static function getGroup(): string { return 'event'; }
    public static function getPriority(): int { return 10; }
}
