<?php

namespace App\Voter;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsSecurity;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;

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
     * @var RequestStack
     */
    private $requestStack;
    private $crud;
    /**
     * @var string
     */
    private $voter;
    /**
     * @var string
     */
    private $object;
    /**
     * @var Security
     */
    private $security;

    /**
     * @param AccessDecisionManagerInterface $decisionManager
     * @param array $blacklistedIp
     * @param RequestStack $requestStack
     * @param Security $security
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager,
                                array $blacklistedIp = array('127.0.0.2', '127.0.0.255'),
                                RequestStack $requestStack,
                                Security $security)
    {
        $this->decisionManager = $decisionManager;
        $this->blacklistedIp = $blacklistedIp;
        $this->requestStack = $requestStack;
        $this->object = '\\App\Voter\\' . (string)ucfirst(current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 1)) . 'Voter');
        $this->voter = (string)current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2));
        $this->security = $security;
    }

    const HOMEPAGE = 'homepage';
    const INDEX = 'index';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($voter, $object): bool
    {
        return true;
    }

    protected function voteOnAttribute($voter, $object, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof VendorsSecurity) {
            throw new CustomUserMessageAuthenticationException('Вы не можете просматривать список. Вы не авторизованы'
            );
            //return false;
        }

        if (in_array($this->requestStack->getMasterRequest()->getClientIp(), $this->blacklistedIp)) {
            return VoterInterface::ACCESS_DENIED;
        }

        if ($this->decisionManager->decide($token, ['ROLE_USER'])) {
            return true;
        }

        $object = $this->object;

        switch ($voter) {

            case self::HOMEPAGE:
                return $this->canHomepage($object, $user);
            case self::INDEX:
                return $this->canIndex($object, $user);
            case self::VIEW:
                return $this->canView($object, $user);
            case self::EDIT:
                return $this->canEdit($object, $user);
            case self::DELETE:
                return $this->canDelete($object, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    public function canIndex($object, $user)
    {
        if ($object->getActive() && $this->canEdit($object, $user)) {
            return true;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canView($object, $user)
    {
        if ($object->getActive() && $this->canEdit($object, $user)) {
            return true;
        }
        return false;
    }

    private function canEdit($object, $user)
    {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        return $object === $object->isAuthor();
    }

    private function canDelete($object, $user)
    {
        if ($object->getActive() && $this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        if ($object->isAuthor() && $object->getActive()) {
            return true;
        }
        return false;
    }

    private function canHomepage($object, $user)
    {
        //TODO: чтобы на главной странице Voter вернуть true при єтом не раздавать никаких прав
        return true;
    }
}

