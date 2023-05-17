<?php

namespace App\Dto;

trait OAuthDTOTrait
{
    /**
        private ?string $emailAuth = null;


        private ?string $emailAuthCode = null;
     **/
    private ?string $facebookId = null;

    private ?string $facebookAccessToken = null;

    private ?string $githubId = null;

    private ?string $githubAccessToken = null;

    private ?string $googleId = null;

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
