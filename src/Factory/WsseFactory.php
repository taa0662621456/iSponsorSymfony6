<?php
/*
    В этом примере не используется класс AbstractFactory,
    это очень полезный базовый класс, который предоставляет
    часто необходимую функциональность для фабрик безопасности.
    Он может быть полезен при определении поставщика безопасности другого типа.
    */

namespace App\Factory;

use App\User\WsseListener;
use App\Service\WsseProvider;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WsseFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, string $id, array $config, string $userProvider, ?string $defaultEntryPoint): array
    {
        $providerId = 'security.authentication.provider.wsse.'.$id;
        $container
            ->setDefinition($providerId, new ChildDefinition(WsseProvider::class))
            ->setArgument(0, new Reference($userProvider))
            ->setArgument(2, $config['lifetime'])
        ;

        $listenerId = 'security.authentication.listener.wsse.'.$id;
        $container->setDefinition($listenerId, new ChildDefinition(WsseListener::class));

        return [$providerId, $listenerId, $defaultEntryPoint];
    }

    public function getPosition(): string
    {
        return 'pre_auth';
    }

    public function getKey(): string
    {
        return 'wsse';
    }

    public function addConfiguration(NodeDefinition $node): void
    {
        $node
            ->children()
            ->scalarNode('lifetime')->defaultValue(300)
            ->end();
    }
}
