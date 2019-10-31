<?php
	declare(strict_types=1);

	namespace App\Voter;

	use App\Entity\Category\Categories;
	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

	class CategoryVoter
	{
		use VoterTrait;

		const VIEW = 'view';
		const EDIT = 'edit';

		protected function supports($attribute, $subject)
		{
			if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
				return false;
			}

			if (!$subject instanceof Categories) {
				return false;
			}

			return true;
		}

		protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
		{
			$vendor = $token->getUser();

			if (!$vendor instanceof Vendors) {
				return false;
			}

			if (in_array($request->getClientIp(), $this->blacklistedIp)) {
				return VoterInterface::ACCESS_DENIED;
			}

			if ($this->decisionManager->decide($token, ['ROLE_USER'])) {
				return true;
			}

			/** @var Categories $category */
			$category = $subject;

			switch ($attribute) {
				case self::VIEW:
					return $this->canView($category, $vendor);
				case self::EDIT:
					return $this->canEdit($category, $vendor);
			}

			throw new \LogicException('This code should not be reached!');
		}

		private function canView(Categories $category, Vendors $vendor)
		{
			// если они могут просматривать, то они могут редактировать
			if ($this->canEdit($category, $vendor)) {
				return true;
			}

			// обьект Post может иметь, например, метод isPrivate(),
			// который проверяет булево свойство $private
			return !$category->isPrivate();
		}

		private function canEdit(Categories $category, Vendors $vendor)
		{
			// предполагает, что объект данных имеет метод getOwner(),
			// чтобы получить сущность пользователя, который владеет этим объектом данных
			return $vendor === $category->getOwner();
		}
	}