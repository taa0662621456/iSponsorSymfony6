<?php

	namespace App\Voter;

	use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

	trait VoterTrait
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
	}