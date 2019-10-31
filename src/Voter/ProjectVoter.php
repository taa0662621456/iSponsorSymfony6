<?php
	declare(strict_types=1);

	namespace App\Voter;

	use App\Entity\Project\Projects;
	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

	class ProjectVoter
	{
		use VoterTrait;

		const VIEW = 'view';
		const EDIT = 'edit';

		protected function supports($attribute, $subject)
		{
			if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
				return false;
			}

			if (!$subject instanceof Projects) {
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

			/** @var Projects $project */
			$project = $subject;

			switch ($attribute) {
				case self::VIEW:
					return $this->canView($project, $vendor);
				case self::EDIT:
					return $this->canEdit($project, $vendor);
			}

			throw new \LogicException('This code should not be reached!');
		}

		private function canView(Projects $project, Vendors $vendor)
		{
			// если они могут просматривать, то они могут редактировать
			if ($this->canEdit($project, $vendor)) {
				return true;
			}

			// обьект Post может иметь, например, метод isPrivate(),
			// который проверяет булево свойство $private
			return !$project->isPrivate();
		}

		private function canEdit(Projects $project, Vendors $vendor)
		{
			// предполагает, что объект данных имеет метод getOwner(),
			// чтобы получить сущность пользователя, который владеет этим объектом данных
			return $vendor === $project->getOwner();
		}
	}