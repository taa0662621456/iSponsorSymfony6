<?php
namespace App\Service;

use App\DataFixtureInterface\GroupedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class BaseGroupedFixture extends Fixture implements GroupedFixtureInterface
{
    //abstract public function load(ObjectManager $manager): void;
}