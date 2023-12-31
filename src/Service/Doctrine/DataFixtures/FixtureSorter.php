<?php

namespace App\Service\Doctrine\DataFixtures;

class FixtureSorter
{
    /**
     * Сортирует фикстуры в правильном порядке, учитывая граф зависимостей.
     *
     * @return string[]
     */
    public function sortFixturesByDependency(array $dependencyGraph): array
    {
        $sortedFixtures = [];
        while (!empty($dependencyGraph)) {
            $resolvedFixture = false;
            foreach ($dependencyGraph as $className => $dependencies) {
                if (empty($dependencies) || $this->areDependenciesResolved($dependencies, $sortedFixtures)) {
                    $sortedFixtures[] = $className;
                    unset($dependencyGraph[$className]);
                    $resolvedFixture = true;
                    break;
                }
            }

            if (!$resolvedFixture) {
                throw new \RuntimeException('Circular dependency detected in fixture groups.');
            }
        }

        return $sortedFixtures;
    }

    /**
     * Проверяет, все ли зависимости данной фикстуры уже разрешены.
     *
     * @param string[] $dependencies
     * @param string[] $resolvedGroups
     */
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
