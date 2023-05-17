<?php

namespace App\Service\Doctrine\DataFixtures;

use App\Attribute\FixtureGroupDependency;
use ReflectionClass;

class FixtureDependencyBuilder
{
    private string $fixtureNamespace;

    public function __construct(string $fixtureNamespace)
    {
        $this->fixtureNamespace = $fixtureNamespace;
    }

    /**
     * Строит граф зависимостей между фикстурами на основе их атрибутов и методов.
     *
     * @param string[] $fixtureClasses
     * @return array
     */
    public function buildDependencyGraph(array $fixtureClasses): array
    {
        $dependencyGraph = [];

        foreach ($fixtureClasses as $fixtureClass) {
            $reflectionClass = new ReflectionClass($fixtureClass);
            $groups = $this->getFixtureGroups($reflectionClass);

            foreach ($groups as $group) {
                if (!isset($dependencyGraph[$group])) {
                    $dependencyGraph[$group] = [
                        'fixture' => $fixtureClass,
                        'dependencies' => [],
                    ];
                }

                $dependencies = $this->getFixtureGroupDependencies($reflectionClass);
                $dependencyGraph[$group]['dependencies'] = array_merge($dependencyGraph[$group]['dependencies'], $dependencies);
            }
        }

        return $dependencyGraph;
    }

    /**
     * Возвращает список групп фикстур, на которые ссылается данный класс фикстуры.
     *
     * @param ReflectionClass $reflectionClass
     * @return string[]
     */
    private function getFixtureGroups(ReflectionClass $reflectionClass): array
    {
        $groups = [];

        $attributes = $reflectionClass->getAttributes(FixtureGroupDependency::class);
        foreach ($attributes as $attribute) {
            $dependency = $attribute->newInstance();
            $groups = array_merge($groups, $dependency->getGroups());
        }

        if (empty($groups)) {
            throw new \RuntimeException(sprintf('No fixture groups found for class "%s".', $reflectionClass->getName()));
        }

        return $groups;
    }

    /**
     * Возвращает список классов фикстур, от которых зависит данный класс фикстуры.
     *
     * @param ReflectionClass $reflectionClass
     * @return string[]
     */
    private function getFixtureGroupDependencies(ReflectionClass $reflectionClass): array
    {
        $dependencies = [];

        // Проверяем, есть ли метод getGroups()
        if ($reflectionClass->hasMethod('getGroups')) {
            $getMethod = $reflectionClass->getMethod('getGroups');
            $groups = $getMethod->invoke(null);

            // Исключаем текущую фикстуру из зависимостей
            $groups = array_diff($groups, [$reflectionClass->getName()]);

            $dependencies = array_merge($dependencies, $groups);
        }

        // Проверяем наличие атрибута FixtureGroupDependency
        $attributes = $reflectionClass->getAttributes(FixtureGroupDependency::class);
        foreach ($attributes as $attribute) {
            $dependency = $attribute->newInstance();
            $groups = $dependency->getGroups();

            // Проверяем наличие каждой группы фикстур
            foreach ($groups as $group) {
                $groupClass = $this->fixtureNamespace . '\\' . $group . '\\' . $reflectionClass->getShortName();
                if (!class_exists($groupClass)) {
                    // Пропускаем отсутствующую группу фикстур
                    continue;
                }
                $dependencies[] = $groupClass;
            }
        }

        return $dependencies;
    }
}
