<?php

namespace App\Service\Doctrine\DataFixtures;

class FixtureGroupLoader1
{
    private string $fixtureNamespace;
    private FixtureFinder $fixtureFinder;
    private FixtureClassResolver $classResolver;
    private FixtureDependencyBuilder $dependencyBuilder;
    private FixtureSorter $sorter;

    public function __construct(
        string $fixtureNamespace,
        FixtureFinder $fixtureFinder,
        FixtureClassResolver $classResolver,
        FixtureDependencyBuilder $dependencyBuilder,
        FixtureSorter $sorter
    ) {
        $this->fixtureNamespace = $fixtureNamespace;
        $this->fixtureFinder = $fixtureFinder;
        $this->classResolver = $classResolver;
        $this->dependencyBuilder = $dependencyBuilder;
        $this->sorter = $sorter;
    }

    public function loadFixturesInOrder(): array
    {
        $fixtures = $this->fixtureFinder->findFixtures();
        $dependencyGraph = $this->dependencyBuilder->buildDependencyGraph($fixtures);
        $sortedFixtures = $this->sorter->sortFixturesByDependency($dependencyGraph);
        return $this->classResolver->resolveFixtureClasses($sortedFixtures);
    }
}
