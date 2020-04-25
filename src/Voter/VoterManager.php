<?php

namespace App\Voter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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
     * @var RequestStack
     */
    private $requestStack;
    private $voter;
    private $crud;

    /**
     * @param AccessDecisionManagerInterface $decisionManager
     * @param array $blacklistedIp
     * @param RequestStack $requestStack
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager,
                                array $blacklistedIp = array('127.0.0.1', '127.0.0.255'),
                                RequestStack $requestStack)
    {
        $this->decisionManager = $decisionManager;
        $this->blacklistedIp = $blacklistedIp;
        $this->requestStack = $requestStack;
        //dd($requestStack->getMasterRequest()->attributes->all());
        $this->voter = 'App\Voter\\' . (string)ucfirst(current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 1)) . 'Voter');
        $this->crud = (string)current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2));

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
        $voter = new $this->voter;
        $crud = $this->crud;
        return $voter->$crud();
    }
}

