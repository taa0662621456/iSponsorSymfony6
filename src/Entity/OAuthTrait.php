<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


trait OAuthTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    private string $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_access_token", type="string", length="510", nullable=true)
     */
    private string $facebookAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    private string $githubId;

    /**
     * @var string
     *
     * @ORM\Column(name="github_access_token", type="string", length="510", nullable=true)
     */
    private string $githubAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private string $googleId;

    /**
     * @var string
     *
     * @ORM\Column(name="google_access_token", type="string", length="510", nullable=true)
     */
    private string $googleAccessToken;

    /**
     * @return string
     */
    public function getFacebookId(): string
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId(string $facebookId): void
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken(): string
    {
        return $this->facebookAccessToken;
    }

    /**
     * @param string $facebookAccessToken
     */
    public function setFacebookAccessToken(string $facebookAccessToken): void
    {
        $this->facebookAccessToken = $facebookAccessToken;
    }

    /**
     * @return string
     */
    public function getGithubId(): string
    {
        return $this->githubId;
    }

    /**
     * @param string $githubId
     */
    public function setGithubId(string $githubId): void
    {
        $this->githubId = $githubId;
    }

    /**
     * @return string
     */
    public function getGithubAccessToken(): string
    {
        return $this->githubAccessToken;
    }

    /**
     * @param string $githubAccessToken
     */
    public function setGithubAccessToken(string $githubAccessToken): void
    {
        $this->githubAccessToken = $githubAccessToken;
    }

    /**
     * @return string
     */
    public function getGoogleId(): string
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     */
    public function setGoogleId(string $googleId): void
    {
        $this->googleId = $googleId;
    }

    /**
     * @return string
     */
    public function getGoogleAccessToken(): string
    {
        return $this->googleAccessToken;
    }

    /**
     * @param string $googleAccessToken
     */
    public function setGoogleAccessToken(string $googleAccessToken): void
    {
        $this->googleAccessToken = $googleAccessToken;
    }



}
