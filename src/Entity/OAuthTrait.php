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
    private string $facebookID;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_access_token", type="string", nullable=true)
     */
    private string $facebookAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    private string $githubID;

    /**
     * @var string
     *
     * @ORM\Column(name="github_access_token", type="string", nullable=true)
     */
    private string $githubAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private string $googleID;

    /**
     * @var string
     *
     * @ORM\Column(name="google_access_token", type="string", nullable=true)
     */
    private string $googleAccessToken;

    /**
     * @return string
     */
    public function getFacebookID(): string
    {
        return $this->facebookID;
    }

    /**
     * @param string $facebookID
     */
    public function setFacebookID(string $facebookID): void
    {
        $this->facebookID = $facebookID;
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
    public function getGithubID(): string
    {
        return $this->githubID;
    }

    /**
     * @param string $githubID
     */
    public function setGithubID(string $githubID): void
    {
        $this->githubID = $githubID;
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
    public function getGoogleID(): string
    {
        return $this->googleID;
    }

    /**
     * @param string $googleID
     */
    public function setGoogleID(string $googleID): void
    {
        $this->googleID = $googleID;
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
