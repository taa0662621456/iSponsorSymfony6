<?php

	namespace App\Voter;

	use Symfony\Component\DependencyInjection\ContainerInterface;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
	use Symfony\Component\Security\Core\Authorization\Voter\Voter;
	use Symfony\Component\Security\Core\User\UserInterface;

	class VoterManager
		extends Voter
	{
		/**
		 * @var AccessDecisionManagerInterface
		 */
		private $decisionManager;

		/**
		 * @var array
		 */
		private $blacklistedIp;

		/**
		 * @var ContainerInterface
		 */
		private $container;

		/**
		 * @param AccessDecisionManagerInterface $decisionManager
		 * @param array                          $blacklistedIp
		 */
		public function __construct(AccessDecisionManagerInterface $decisionManager,
									array $blacklistedIp = array('127.0.0.1', '127.0.0.255'))
		{
			$this->decisionManager = $decisionManager;
			$this->blacklistedIp = $blacklistedIp;
		}

		protected function supports($voter,
									$entity): bool
		{
			return true;
		}

		protected function voteOnAttribute($voter, $entity, TokenInterface $token)
		{
			$user = $token->getUser();
			if (!($user instanceof UserInterface)) {
				return null;
			}

			$voter = $this->container->get('request_stack')->getParentRequest()->attributes->get('_route');
			$voterAttrArray = explode('_', $voter, 3);
			$voterClass = ucfirst(strtolower($voterAttrArray[0])) . 'Voters';
			$voterMethod = strtolower($voterAttrArray[1]);

			$voter = new $voterClass();

			return $voter->$voterMethod();
		}
	}

