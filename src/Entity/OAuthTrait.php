<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


trait OAuthTrait
{


    #[ORM\Column(name: 'facebook_id', type: 'string', nullable: true)]
    private string $facebookId;


    #[ORM\Column(name: 'facebook_access_token', type: 'string', length: 510, nullable: true)]
    private string $facebookAccessToken;


    #[ORM\Column(name: 'github_id', type: 'string', nullable: true)]
    private string $githubId;


    #[ORM\Column(name: 'github_access_token', type: 'string', length: 510, nullable: true)]
    private string $githubAccessToken;


    #[ORM\Column(name: 'google_id', type: 'string', nullable: true)]
    private string $googleId;


    #[ORM\Column(name: 'google_access_token', type: 'string', length: 510, nullable: true)]
    private string $googleAccessToken;

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

    public function getGoogleAccessToken(): string
    {
        return $this->googleAccessToken;
    }

    public function setGoogleAccessToken(string $googleAccessToken): void
    {
        $this->googleAccessToken = $googleAccessToken;
    }



}
