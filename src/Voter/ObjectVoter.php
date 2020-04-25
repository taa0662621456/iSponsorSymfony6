<?php


namespace App\Voter;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;

class ObjectVoter
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
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var string
     */
    private $object;

    /**
     * @param Request $request
     * @param AccessDecisionManagerInterface $decisionManager
     * @param array $blacklistedIp
     * @param RequestStack $requestStack
     * @param Security $security
     */
    public function __construct(Request $request,
                                AccessDecisionManagerInterface $decisionManager,
                                array $blacklistedIp = array('127.0.0.1', '127.0.0.255'),
                                RequestStack $requestStack,
                                Security $security)
    {
        $this->request = $request;
        $this->decisionManager = $decisionManager;
        $this->blacklistedIp = $blacklistedIp;
        $this->security = $security;
        $this->requestStack = $requestStack;
        $this->object = 'App\\Entity\\' . (string)ucfirst(current(explode('_',
                $requestStack->getMasterRequest()->attributes->get('_route'), 1)));

    }

    const INDEX = 'index';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::INDEX, self::VIEW, self::EDIT, self::DELETE))) {
            return false;
        }

        if (!$subject instanceof $this->object) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof $this->object) {
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

        $object = $this->object = $subject;

        switch ($attribute) {
            case self::INDEX:
                return $this->canIndex($object);
            case self::VIEW:
                return $this->canView($object);
            case self::EDIT:
                return $this->canEdit($object);
            case self::DELETE:
                return $this->canDelete($object);
        }

        throw new \LogicException('This code should not be reached!');
    }

    public function canIndex($object)
    {
        if ($object->getActive() && $this->canEdit($object)) {
            return true;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canView($object)
    {
        if ($object->getActive() && $this->canEdit($object)) {
            return true;
        }
        return false;
    }

    private function canEdit($object)
    {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        return $object === $object->isAuthor();
    }

    private function canDelete($object)
    {
        if ($object->getActive() && $this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        if ($object->isAuthor() && $object->getActive()) {
            return true;
        }
        return false;
    }
}