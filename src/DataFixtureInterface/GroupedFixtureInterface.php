<?php
namespace App\DataFixtureInterface;

interface GroupedFixtureInterface
{
    public static function getGroup(): string;
    public static function getPriority(): int;
}