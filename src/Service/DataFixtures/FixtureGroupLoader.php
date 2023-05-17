<?php

namespace App\Service\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use App\Exception\Doctrine\DataFixtures\FixturesGroupNotFoundException;

class FixtureGroupLoader
{
    private string $fixtureNamespace;

    private array $dependencyMap;

    public function __construct(string $fixtureNamespace = 'App\DataFixtures', array $dependencyMap = [
        'Address' => ['Product', 'Project'],
    ])
    {
        $this->fixtureNamespace = $fixtureNamespace;
        $this->dependencyMap = $dependencyMap;
    }

    /**
     * Загружает фикстуры в определенном порядке с учетом групповой зависимости.
     *
     * @throws FixturesGroupNotFoundException если возникла ошибка при загрузке фикстур
     *
     * @return array массив фикстур, отсортированных по зависимостям
     */
    public function loadFixturesInOrder(): array
    {
        $fixtures = $this->findFixtures();
        var_dump($fixtures);

        $dependencyGraph = $this->buildDependencyGraph($fixtures);
        var_dump($dependencyGraph);

        // Проверяем, есть ли несуществующие группы фикстур
        $undefinedGroups = array_diff(array_keys($dependencyGraph), array_keys($this->dependencyMap));
        if (!empty($undefinedGroups)) {
            throw new FixturesGroupNotFoundException(sprintf('Undefined fixture groups: %s', implode(', ', $undefinedGroups)));
        }

        return $this->sortFixturesByDependency($dependencyGraph);
    }

    private function findFixtures(): array
    {
        $fixtureFiles = glob(__DIR__.'/../../DataFixtures/*Fixture.php');
        $fixtures = []; // Объявление переменной $fixtures

        foreach ($fixtureFiles as $fixtureFile) {
            var_dump('Before getFixtureClass'); // Добавлен для отладки
            var_dump('Fixture File:', $fixtureFile);
            $fixtureClass = $this->getFixtureClass($fixtureFile);
            var_dump('After getFixtureClass'); // Добавлен для отладки

            if (is_subclass_of($fixtureClass, FixtureInterface::class)) {
                $fixtures[] = new $fixtureClass();
            }
            $fixtures[] = new $fixtureClass();
            die();
        }

        var_dump('Fixtures:', $fixtures);
        var_dump('End:');

        return $fixtures;
    }

    private function getFixtureClass(string $file): string
    {
        var_dump('file', $file);

        $relativePath = pathinfo($file, \PATHINFO_DIRNAME);
        var_dump('relativePath', $relativePath);
        $namespace = str_replace('/', '\\', $relativePath);
        var_dump('namespace', $namespace);

        $class = pathinfo($file, \PATHINFO_FILENAME);

        $fixtureClass = $this->fixtureNamespace.'\\'.$namespace.'\\'.$class;
        var_dump('Fixture Class:', $fixtureClass); // Добавлен для отладки

        return $fixtureClass;
    }

    private function buildDependencyGraph(array $fixtures): array
    {
        $dependencyGraph = [];

        foreach ($fixtures as $fixture) {
            $reflectionClass = new \ReflectionClass($fixture);
            $className = $reflectionClass->getName();
            $groups = $this->getFixtureGroups($className, $fixture);
            $dependencies = $this->getFixtureDependencies($className, $fixture);

            // Добавляем текущую фикстуру в каждую группу
            foreach ($groups as $group) {
                if (!isset($dependencyGraph[$group])) {
                    $dependencyGraph[$group] = [
                        'fixtures' => [],
                        'dependencies' => [],
                    ];
                }

                $dependencyGraph[$group]['fixtures'][] = $fixture;
            }

            // Добавляем зависимости для каждой группы
            foreach ($dependencies as $dependency) {
                if (!isset($dependencyGraph[$dependency])) {
                    $dependencyGraph[$dependency] = [
                        'fixtures' => [],
                        'dependencies' => [],
                    ];
                }

                $dependencyGraph[$dependency]['dependencies'][] = $fixture;
            }
        }

        return $dependencyGraph;
    }

    private function getFixtureDependencies($fixture): array
    {
        $reflectionClass = new \ReflectionClass($fixture);
        $dependencies = [];

        // Проверяем, есть ли метод getGroups()
        if ($reflectionClass->hasMethod('getGroups')) {
            $getMethod = $reflectionClass->getMethod('getGroups');
            $groups = $getMethod->invoke($fixture);

            $dependencies = array_merge($dependencies, $groups);
        }
        var_dump($dependencies);

        return $dependencies;
    }

    private function getFixtureGroups($fixture): array
    {
        $reflectionClass = new \ReflectionClass($fixture);
        $className = $reflectionClass->getShortName();
        $matches = [];

        // Ищем первое слово с большой буквы
        preg_match('/[A-Z][a-z]+/', $className, $matches);

        if (!empty($matches)) {
            $group = $matches[0];

            return [$group];
        }

        return [];
    }

    /**
     * @throws FixturesGroupNotFoundException
     */
    private function sortFixturesByDependency(array $fixtures): array
    {
        $sortedFixtures = [];
        $resolvedFixtures = [];

        while (!empty($fixtures)) {
            $resolvedFixture = false;

            foreach ($fixtures as $key => $fixtureData) {
                $dependencies = array_keys($fixtureData['dependencies']);
                if (empty($dependencies) || $this->areDependenciesResolved($dependencies, $resolvedFixtures)) {
                    $sortedFixtures[] = $fixtureData['fixture'];
                    $resolvedFixtures[] = $fixtureData['fixture']; // Добавляем резолвенную фикстуру
                    unset($fixtures[$key]);
                    $resolvedFixture = true;
                    break;
                }
            }

            if (!$resolvedFixture) {
                throw new FixturesGroupNotFoundException('Circular dependency detected in fixture groups.');
            }
        }

        return $sortedFixtures;
    }

    private function areDependenciesResolved(array $dependencies, array $resolvedGroups): bool
    {
        foreach ($dependencies as $dependency) {
            if (!\in_array($dependency, $resolvedGroups)) {
                return false;
            }
        }

        return true;
    }
}
