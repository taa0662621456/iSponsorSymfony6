<?php

namespace App\Voter;

use App\Entity\Vendor\Vendor;
use LogicException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;

class VoterManager extends Voter
{
    /**
     * @var AccessDecisionManagerInterface
     */
    private AccessDecisionManagerInterface $decisionManager;
    /**
     * @var array
     */
    private array $blacklistedIp;
    /**
     * @var RequestStack
     */
    private RequestStack $requestStack;

    private string $voter;

    private string $object;
    /**
     * @var Security
     */
    private Security $security;

    /**
     * @param AccessDecisionManagerInterface $decisionManager
     * @param array $blacklistedIp
     * @param RequestStack $requestStack
     * @param Security $security
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager,
                                RequestStack $requestStack,
                                Security $security,
                                array $blacklistedIp = array('127.0.0.2', '127.0.0.255'))
    {
        $this->decisionManager = $decisionManager;
        $this->blacklistedIp = $blacklistedIp;
        $this->requestStack = $requestStack;
        $this->object = '\\App\Voter\\' . ucfirst(current(explode('_', $requestStack->getMainRequest()->attributes->get('_route'), 1)) . 'Voter');
        $this->voter = (string)current(explode('_', $requestStack->getMainRequest()->attributes->get('_route', 2), 2));
        $this->security = $security;
    }

    const HOMEPAGE = 'homepage';
    const INDEX = 'index';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject): bool
    {
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {

        if ($token instanceof NullToken) {
            // https://symfony.com/doc/current/security/authenticator_manager.html
            // the user is not authenticated, e.g. only allow them to
            // see public posts
//            return $subject->isActive(); //TODO: доработать метод
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof Vendor) {
            throw new CustomUserMessageAuthenticationException('Вы не можете просматривать список. Вы не авторизованы'
            );
            //return false;
        }

        if (in_array($this->requestStack->getMainRequest()->getClientIp(), $this->blacklistedIp)) {
            return VoterInterface::ACCESS_DENIED;
        }

        if ($this->decisionManager->decide($token, ['ROLE_USER'])) {
            return true;
        }

        $subject = $this->object;

        switch ($attribute) {

            case self::HOMEPAGE:
                return $this->canHomepage($subject, $user);
            case self::INDEX:
                return $this->canIndex($subject, $user);
            case self::VIEW:
                return $this->canView($subject, $user);
            case self::EDIT:
                return $this->canEdit($subject, $user);
            case self::DELETE:
                return $this->canDelete($subject, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    public final function canIndex($object, $user): bool
    {
        if ($object->getIsActive() && $this->canEdit($object, $user)) {
            return true;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canView($object, $user): bool
    {
        if ($object->getIsActive() && $this->canEdit($object, $user)) {
            return true;
        }
        return false;
    }

    private function canEdit($object, $user): bool
    {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        return $object === $object->isAuthor();
    }

    private function canDelete($object, $user): bool
    {
        if ($object->getActive() && $this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        if ($object->isAuthor() && $object->getActive()) {
            return true;
        }
        return false;
    }

    private function canHomepage($object, $user, TokenInterface $token): bool
    {
        if ($token instanceof NullToken) {
            // the user is not authenticated, e.g. only allow them to
            // see public posts
            return true;
        }
        return false;
    }
}
