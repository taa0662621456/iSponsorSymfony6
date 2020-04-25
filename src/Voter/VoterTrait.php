<?php

	namespace App\Voter;

	use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
    use Symfony\Component\Security\Core\Security;


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
         * @var Request
         */
        private $request;
        /**
         * @var Security
         */
        private $security;

        /**
         * @param Request $request
         * @param AccessDecisionManagerInterface $decisionManager
         * @param array $blacklistedIp
         * @param Security $security
         */
		public function __construct(Request $request,
                                    AccessDecisionManagerInterface $decisionManager,
									array $blacklistedIp = array('127.0.0.1', '127.0.0.255'),
                                    Security $security)
		{
		    $this->request = $request;
			$this->decisionManager = $decisionManager;
			$this->blacklistedIp = $blacklistedIp;
			$this->security = $security;
		}
	}