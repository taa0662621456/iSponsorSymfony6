<?php


namespace App\Security;


use App\Entity\Vendor\VendorSecurity;
use HWI\Bundle\OAuthBundle\Connect\AccountConnectorInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\EntityUserProvider;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class OAuthAuthenticator extends EntityUserProvider implements AccountConnectorInterface
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface|VendorSecurity
    {
        $resourceOwnerName = $response->getResourceOwner()->getName();

        if (!isset($this->properties[$resourceOwnerName])) {
            throw new \RuntimeException(sprintf("No property defined for entity for resource owner '%s'.", $resourceOwnerName));
        }

        $serviceName = $response->getResourceOwner()->getName();
        $setterId = 'set'. ucfirst($serviceName) . 'ID';
        $setterAccessToken = 'set'. ucfirst($serviceName) . 'AccessToken';

        // unique integer
        $username = $response->getUsername();
        $email = $response->getEmail();
        if (null === $user = $this->findUser([$this->properties[$resourceOwnerName] => $username])) {
            // TODO: Create new user
            if (null === $user = $this->findUser(['email' => $email])){
                $user = new VendorSecurity();
                $user->setIsVerified(true);
                $user->setEmail($response->getEmail());
                $user->setPassword(md5(uniqid('', true)));
            }
            else{
                $user->setIsVerified(true);
            }
            $user->$setterId($username);
        }

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
        $username = $response->getUsername();

        if (null !== $previousUser = $this->registry->getRepository(VendorSecurity::class)->findOneBy(array($property => $username))) {
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
        $resourceOwnerName = $response->getResourceOwner()->getName();

        if (!isset($this->properties[$resourceOwnerName])) {
            throw new \RuntimeException(sprintf("No property defined for entity for resource owner '%s'.", $resourceOwnerName));
        }

        return $this->properties[$resourceOwnerName];
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
        $user->setEmail($response->getEmail());
        // TODO: Add more fields?!

        $this->em->persist($user);
        $this->em->flush();
    }

}
