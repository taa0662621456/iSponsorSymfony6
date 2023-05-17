<?php

namespace App\Service\Doctrine\DataFixtures;

use Symfony\Component\Finder\Finder;

class FixtureFinder
{
    private string $fixtureDirectory;

    public function __construct(string $fixtureDirectory)
    {
        $this->fixtureDirectory = $fixtureDirectory;
    }

    /**
     * Находит и возвращает список файлов с фикстурами в указанной директории.
     *
     * @return string[]
     */
    public function findFixtures(): array
    {
        $fixtures = [];

        $finder = new Finder();
        $finder->files()->in($this->fixtureDirectory)->name('*Fixture.php');

        foreach ($finder as $file) {
            $fixtures[] = $file->getRealPath();
        }

        return $fixtures;
    }
}

