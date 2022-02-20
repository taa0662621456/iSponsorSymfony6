<?php

namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use HWI\Bundle\OAuthBundle\Connect\AccountConnectorInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class HWIOAuthAuthenticator implements AccountConnectorInterface, OAuthAwareUserProviderInterface
{

    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface|VendorSecurity
    {
        $resource = $serviceName = $response->getResourceOwner()->getName();
        if (isset($this->properties[$resource])) {
            throw new \RuntimeException(sprintf("No property defined for entity for resource owner '%s'.", $resource));
        }

        $property = $response->getResourceOwner()->getName() . 'Id';
        $setterId = 'set'. ucfirst($serviceName) . 'Id';
        $setterAccessToken = 'set'. ucfirst($serviceName) . 'AccessToken';

        //TODO: в целом можно усовершенствовать запись и обновление персональных данных...
        $id = $response->getData()['id'];
        $name = $response->getData()['name']; //TODO: разобрать на имя и фамилию
        $email = $username = $response->getData()['email'];

        if (null == $user = $this->findUser([$property => $id])) { // Found

            if (null == $user = $this->findUser(['email' => $email])) {
                # A New User
                $user = new VendorSecurity();
                $user->setPublished(true);
                $user->setEmail($email);
                $user->setPassword(md5(uniqid('', true)));
            }

        }
        # Update UserToken
        $user->$setterId($id);
        $user->$setterAccessToken($response->getAccessToken());
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        if (!$user instanceof VendorSecurity) {
            throw new UnsupportedUserException(sprintf('Expected an instance of App\Model\User, but got "%s".', get_class($user)));
        }

        $property = $this->getProperty($response);
        $id = $response->getData()['id'];
//        $name = $response->getData()['name']; //TODO: разобрать на имя и фамилию
//        $email = $username = $response->getData()['email'];

        if (null !== $previousUser = $this->registry->getRepository(VendorSecurity::class)->findOneBy(array($property => $id))) {
            // 'disconnect' previously connected users
            $this->disconnect($previousUser, $response);
        }


        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set'. ucfirst($serviceName) . 'AccessToken';

        $user->$setter($response->getAccessToken());

        $this->updateUser($user, $response);
    }

    /**
     * @param UserResponseInterface $response
     * @return string
     * @throws \RuntimeException
     */
    protected function getProperty(UserResponseInterface $response): string
    {

        $resource = $response->getResourceOwner()->getName();
        if (!isset($this->properties[$resource])) {
            throw new \RuntimeException(sprintf("No property defined for entity for resource owner '%s'.", $resource));
        }

        return $this->properties[$resource];
    }

    /**
     * Disconnects a user.
     * @param UserInterface $user
     * @param UserResponseInterface $response
     * @throws \TypeError
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $accessor = PropertyAccess::createPropertyAccessor();

        $accessor->setValue($user, $property, null);

        $this->updateUser($user, $response);
    }

    /**
     * Update the user and persist the changes to the database.
     * @param UserInterface $user
     * @param UserResponseInterface $response
     */
    private function updateUser(UserInterface $user, UserResponseInterface $response)
    {
        $user->setEmail($response->getData()['email']);
        // TODO: Add more fields?!

        $this->em->persist($user);
        $this->em->flush();
    }
}

