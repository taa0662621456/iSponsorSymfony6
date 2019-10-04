<?php
	/*
		В этом примере не используется класс AbstractFactory,
		это очень полезный базовый класс, который предоставляет
		часто необходимую функциональность для фабрик безопасности.
		Он может быть полезен при определении поставщика безопасности другого типа.
		*/

	namespace App\Factory;

	use App\Listener\WsseListener;
	use App\Service\WsseProvider;
	use Symfony\Component\DependencyInjection\ChildDefinition;
	use Symfony\Component\DependencyInjection\ContainerBuilder;
	use Symfony\Component\DependencyInjection\Reference;
	use Symfony\Component\Config\Definition\Builder\NodeDefinition;
	use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;

	class WsseFactory implements SecurityFactoryInterface
	{
		public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
		{
			$providerId = 'security.authentication.provider.wsse.' . $id;
			$container
				->setDefinition($providerId, new ChildDefinition(WsseProvider::class))
				->replaceArgument(0, new Reference($userProvider));

			$listenerId = 'security.authentication.listener.wsse.' . $id;
			$listener = $container->setDefinition($listenerId, new ChildDefinition(WsseListener::class));

			return array($providerId, $listenerId, $defaultEntryPoint);
		}

		public function getPosition()
		{
			return 'pre_auth';
		}

		public function getKey()
		{
			return 'wsse';
		}

		public function addConfiguration(NodeDefinition $node)
		{
			$node
				->children()
				->scalarNode('lifetime')->defaultValue(300)
				->end();
		}
	}