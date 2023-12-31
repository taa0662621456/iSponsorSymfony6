<?php

namespace App\Service\Doctrine\DataFixtures;

class FixtureClassResolver
{
    private string $fixtureNamespace;

    public function __construct(string $fixtureNamespace)
    {
        $this->fixtureNamespace = $fixtureNamespace;
    }

    /**
     * Преобразует найденные файлы с фикстурами в соответствующие классы фикстур.
     *
     * @param string[] $files
     *
     * @return string[]
     */
    public function resolveFixtureClasses(array $files): array
    {
        $classes = [];

        foreach ($files as $file) {
            $className = $this->getFixtureClass($file);
            $classes[] = $className;
        }

        return $classes;
    }

    /**
     * Возвращает полное имя класса фикстуры на основе пути к файлу и пространства имен.
     */
    private function getFixtureClass(string $file): string
    {
        $relativePath = \dirname($file);
        $namespace = str_replace('/', '\\', $relativePath);
        $class = pathinfo($file, \PATHINFO_FILENAME);

        return $this->fixtureNamespace.'\\'.$namespace.'\\'.$class;
    }
}
