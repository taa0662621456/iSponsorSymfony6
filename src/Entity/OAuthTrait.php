<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


trait OAuthTrait
{
/**
    #[ORM\Column(name: 'email_auth', type: 'string', nullable: true)]
    private ?string $emailAuth = null;

    #[ORM\Column(name: 'email_auth_code', type: 'string', nullable: true)]
    private ?string $emailAuthCode = null;
**/

    #[ORM\Column(name: 'facebook_id', type: 'string', nullable: true)]
    private ?string $facebookId = null;


    #[ORM\Column(name: 'facebook_access_token', type: 'string', length: 510, nullable: true)]
    private ?string $facebookAccessToken = null;


    #[ORM\Column(name: 'github_id', type: 'string', nullable: true)]
    private ?string $githubId = null;


    #[ORM\Column(name: 'github_access_token', type: 'string', length: 510, nullable: true)]
    private ?string $githubAccessToken = null;


    #[ORM\Column(name: 'google_id', type: 'string', nullable: true)]
    private ?string $googleId = null;

    #[ORM\Column(name: 'google_access_token', type: 'string', length: 510, nullable: true)]
    private ?string $googleAccessToken = null;
/**
    public function isEmailAuthEnabled(): bool
    {
        return true; // This can be a persisted field to switch email code authentication on/off
    }
    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }
    public function getEmailAuthCode(): string
    {
        if (null === $this->emailAuthCode) {
            throw new \LogicException('The email authentication code was not set');
        }

        return $this->emailAuthCode;
    }
    public function setEmailAuthCode(string $emailAuthCode): void
    {
        $this->emailAuthCode = $emailAuthCode;
    }
*/
    public function getFacebookId(): string
    {
        return $this->facebookId;
    }

    public function setFacebookId(string $facebookId): void
    {
        $this->facebookId = $facebookId;
    }

    public function getFacebookAccessToken(): string
    {
        return $this->facebookAccessToken;
    }

    public function setFacebookAccessToken(string $facebookAccessToken): void
    {
        $this->facebookAccessToken = $facebookAccessToken;
    }

    public function getGithubId(): string
    {
        return $this->githubId;
    }

    public function setGithubId(string $githubId): void
    {
        $this->githubId = $githubId;
    }

    public function getGithubAccessToken(): string
    {
        return $this->githubAccessToken;
    }

    public function setGithubAccessToken(string $githubAccessToken): void
    {
        $this->githubAccessToken = $githubAccessToken;
    }

    public function getGoogleId(): string
    {
        return $this->googleId;
    }

    public function setGoogleId(string $googleId): void
    {
        $this->googleId = $googleId;
    }

    public function getGoogleAccessToken(): ?string
    {
        return $this->googleAccessToken;
    }

    public function isGoogleAccessToken(): bool
    {
        return null !== $this->googleAccessToken;
    }

    public function setGoogleAccessToken(?string $googleAccessToken): void
    {
        $this->googleAccessToken = $googleAccessToken;
    }

    public function getGoogleUsername(): string
    {
        return $this->username;
    }

}
