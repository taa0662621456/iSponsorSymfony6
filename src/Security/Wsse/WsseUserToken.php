<?php
namespace App\Security\Wsse;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class WsseUserToken extends AbstractToken
{
    public $created;
    public $digest;
    public $nonce;

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // Если пользователь имеет роли, считайте его аутентифицированным
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials(): string
    {
        return '';
    }
}
