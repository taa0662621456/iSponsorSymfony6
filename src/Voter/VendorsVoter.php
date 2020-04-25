<?php
	namespace App\Voter;
	use App\Entity\Vendor\Vendors;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

    class VendorsVoter
	{
        use VoterTrait;

        const INDEX = 'index';
        const VIEW = 'view';
        const EDIT = 'edit';
        const DELETE = 'delete';

        protected function supports($attribute, $subject)
        {
            if (!in_array($attribute, array(self::INDEX, self::VIEW, self::EDIT, self::DELETE))) {
                return false;
            }

            if (!$subject instanceof Vendors) {
                return false;
            }


            return true;
        }

        protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
        {
            $vendor = $token->getUser();

            if (!$vendor instanceof Vendors) {
                throw new CustomUserMessageAuthenticationException('Вы не можете просматривать список. Вы не авторизованы'
                );
                //return false;
            }

            if (in_array($this->request->getClientIp(), $this->blacklistedIp)) {
                return VoterInterface::ACCESS_DENIED;
            }

            if ($this->decisionManager->decide($token, ['ROLE_USER'])) {
                return true;
            }

            /** @var Vendors $vendors */
            $vendors = $subject;

            switch ($attribute) {
                case self::INDEX:
                    return $this->canIndex($vendors, $vendor);
                case self::VIEW:
                    return $this->canView($vendors, $vendor);
                case self::EDIT:
                    return $this->canEdit($vendors, $vendor);
                case self::DELETE:
                    return $this->canDelete($vendors, $vendor);
            }

            throw new \LogicException('This code should not be reached!');
        }

        public function canIndex(Vendors $vendors, Vendors $vendor)
        {
            if ($vendor->getActive() && $this->canEdit($vendors, $vendor)) {
                return true;
            }

            if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
                return true;
            }

            return false;
        }

        private function canView(Vendors $vendors, Vendors $vendor)
        {
            if ($vendor->getActive() && $this->canEdit($vendors, $vendor)) {
                return true;
            }
            return false;
        }

        private function canEdit(Vendors $vendors, Vendors $vendor)
        {
            // ROLE_SUPER_ADMIN can do anything! The power!
            if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
                return true;
            }
            return $vendor === $vendor->isAuthor();
        }

        private function canDelete(Vendors $vendors, Vendors $vendor)
        {
            if ($vendor->getActive() && $this->security->isGranted('ROLE_SUPER_ADMIN')) {
                return true;
            }
            if ($vendor->isAuthor() && $vendor->getActive()) {
                return true;
            }
            return false;
        }
    }