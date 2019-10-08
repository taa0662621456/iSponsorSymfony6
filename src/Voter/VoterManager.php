<?php
	/**
	 * https://symfony.com.ua/doc/current/security/voters.html
	 */

	namespace App\Service;

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
		private AccessDecisionManagerInterface $decisionManager;

		public const CREATE = 'create';
		public const DELETE = 'delete';
		public const EDIT   = 'edit';
		public const SHOW   = 'show';

		public function __construct(AccessDecisionManagerInterface $decisionManager)
		{
			$this->decisionManager = $decisionManager;
		}

		/**
		 * {@inheritdoc}
		 */
		protected function supports($attribute,
									$entity): bool
		{

			if (!in_array($attribute, [self::CREATE, self::EDIT, self::DELETE, self::SHOW])) {
				return false;
			}

			return true;
		}

		/**
		 * {@inheritdoc}
		 */
		protected function voteOnAttribute(TokenInterface $token,
										   $entity,
										   $attributes): bool
		{
			$user = $token->getUser();
			if (!($user instanceof UserInterface)) {
				return null;
			}

			switch ($attributes) {

				case self::CREATE:
					if ($this->decisionManager->decide($token, ['ROLE_USER'])) {
						return true;
					}

					break;

				case self::EDIT:
					if ($entity->isAuthor() or
						$this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
						return true;
					}

					break;
			}
			return false;
		}
	}