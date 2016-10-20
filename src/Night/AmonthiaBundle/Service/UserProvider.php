<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 10/20/16
 * Time: 1:04 PM
 */

namespace Night\AmonthiaBundle\Service;

use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider extends BaseProvider
{
    protected $passwordEncoder;

    public function __construct(UserManagerInterface $userManager, UserPasswordEncoderInterface $passwordEncoder, array $properties)
    {
        $this->passwordEncoder = $passwordEncoder;
        parent::__construct($userManager, $properties);
    }

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';
        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
    }
    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        if(null === $user) {
            $user = $this->userManager->findUserBy(['emailCanonical' => $response->getEmail()]);
        }
       if(null === $user) {
            $user = $this->userManager->findUserBy(['usernameCanonical' => $response->getNickname()]);
        }
        //when the user is registrating
        if (null === $user) {
//             create new user here
            $user = $this->userManager->createUser();
//
//            I have set all requested data with the user's username
//            modify here with relevant data
            $user->setUsername($response->getNickname());
            $user->setEmail($response->getEmail());
            $user->setPassword($this->passwordEncoder->encodePassword($user, $username));
            $user->setEnabled(true);
        }
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
        return $user;
    }

}