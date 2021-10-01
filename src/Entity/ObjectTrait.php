<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


trait ObjectTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="first_title", type="string", nullable=false,
     *     options={"default"="first_title"})
     * @Assert\NotBlank(message="object_en_gb.blank_content")
     * @Assert\Length(min=6, minMessage="object_en_gb.too_short_content")
     */
    private $firstTitle = 'first_title';

    /**
     * @var string
     *
     * @ORM\Column(name="middle_title", type="text", nullable=false, options={"default"="middle_title"})
     * @Assert\NotBlank(message="object_en_gb.blank_content")
     * @Assert\Length(min=10, minMessage="object_en_gb.too_short_content")
     */
    private $middleTitle = 'middle_title';

    /**
     * @var string
     *
     * @ORM\Column(name="last_title", type="text", nullable=false, options={"default"="last_title"})
     * @Assert\NotBlank(message="object_en_gb.blank_content")
     * @Assert\Length(min=6, minMessage="object_en_gb.too_short_content")
     */
    private $lastTitle = 'last_title';


    /**
     * @var string
     *
     * @ORM\Column(name="meta_desc", type="text", nullable=false, options={"default"="meta_desc"})
     * @Assert\NotBlank(message="object_en_gb.blank_content")
     * @Assert\Length(min=6, minMessage="object_en_gb.too_short_content")
     */
    private $metaDesc = 'meta_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", nullable=false, options={"default"="meta_key"})
     * @Assert\NotBlank(message="object_en_gb.blank_content")
     * @Assert\Length(min=6, minMessage="object_en_gb.too_short_content")
     */
    private $metaKey = 'meta_keywords';

    /**
     * @return string
     */
    public function getFirstTitle(): string
    {
        return $this->firstTitle;
    }

    /**
     * @param string $firstTitle
     */
    public function setFirstTitle(string $firstTitle): void
    {
        $this->firstTitle = $firstTitle;
    }

    /**
     * @return string
     */
    public function getMiddleTitle(): string
    {
        return $this->middleTitle;
    }

    /**
     * @param string $middleTitle
     */
    public function setMiddleTitle(string $middleTitle): void
    {
        $this->middleTitle = $middleTitle;
    }

    /**
     * @return string
     */
    public function getLastTitle(): string
    {
        return $this->lastTitle;
    }

    /**
     * @param string $lastTitle
     */
    public function setLastTitle(string $lastTitle): void
    {
        $this->lastTitle = $lastTitle;
    }

    /**
     * @return string
     */
    public function getMetaDesc(): string
    {
        return $this->metaDesc;
    }

    /**
     * @param string $metaDesc
     */
    public function setMetaDesc(string $metaDesc): void
    {
        $this->metaDesc = $metaDesc;
    }

    /**
     * @return string
     */
    public function getMetaKey(): string
    {
        return $this->metaKey;
    }

    /**
     * @param string $metaKey
     */
    public function setMetaKey(string $metaKey): void
    {
        $this->metaKey = $metaKey;
    }

}
