<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @ORM\Table(name="languages", uniqueConstraints={
 * @ORM\UniqueConstraint(name="idx_sef", columns={"sef"}),
 * @ORM\UniqueConstraint(name="idx_langcode", columns={"lang_code"})}, indexes={
 * @ORM\Index(name="idx_access", columns={"access"}),
 * @ORM\Index(name="idx_ordering", columns={"ordering"})})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 */
class PlatformLang
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lang_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $langId;

    /**
     * @var integer
     *
     * @ORM\Column(name="asset_id", type="integer", nullable=false)
     */
    private $assetId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="lang_code", type="string", nullable=false, options={"default"=""})
     */
    private $langCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false, options={"default"=""})
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="title_native", type="string", nullable=false, options={"default"=""})
     */
    private $titleNative = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sef", type="string", nullable=false, options={"default"=""})
     */
    private $sef = '';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=false, options={"default"=""})
     */
    private $image = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false, options={"default"=""})
     */
    private $description = '';

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="text", nullable=false, options={"default"=""})
     */
    private $metakey = '';

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="text", nullable=false, options={"default"=""})
     */
    private $metadesc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sitename", type="string", nullable=false, options={"default"=""})
     */
    private $sitename = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", nullable=false)
     */
    private $published = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="access", type="integer", nullable=false)
     */
    private $access = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = 0;

    /**
     * @return int
     */
    public function getLangId(): int
    {
        return $this->langId;
    }

    /**
     * @return int
     */
    public function getAssetId(): int
    {
        return $this->assetId;
    }

    /**
     * @return string
     */
    public function getLangCode(): string
    {
        return $this->langCode;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitleNative(): string
    {
        return $this->titleNative;
    }

    /**
     * @return string
     */
    public function getSef(): string
    {
        return $this->sef;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getMetakey(): string
    {
        return $this->metakey;
    }

    /**
     * @return string
     */
    public function getMetadesc(): string
    {
        return $this->metadesc;
    }

    /**
     * @return string
     */
    public function getSitename(): string
    {
        return $this->sitename;
    }

    /**
     * @return int
     */
    public function getPublished(): int
    {
        return $this->published;
    }

    /**
     * @return int
     */
    public function getAccess(): int
    {
        return $this->access;
    }

    /**
     * @return int
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }





    /**
     * Setters
     */

    /**
     * @param int $langId
     */
    public function setLangId(int $langId): void
    {
        $this->langId = $langId;
    }

    /**
     * @param int $assetId
     */
    public function setAssetId(int $assetId): void
    {
        $this->assetId = $assetId;
    }

    /**
     * @param string $langCode
     */
    public function setLangCode(string $langCode): void
    {
        $this->langCode = $langCode;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $titleNative
     */
    public function setTitleNative(string $titleNative): void
    {
        $this->titleNative = $titleNative;
    }

    /**
     * @param string $sef
     */
    public function setSef(string $sef): void
    {
        $this->sef = $sef;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $metakey
     */
    public function setMetakey(string $metakey): void
    {
        $this->metakey = $metakey;
    }

    /**
     * @param string $metadesc
     */
    public function setMetadesc(string $metadesc): void
    {
        $this->metadesc = $metadesc;
    }

    /**
     * @param string $sitename
     */
    public function setSitename(string $sitename): void
    {
        $this->sitename = $sitename;
    }

    /**
     * @param int $published
     */
    public function setPublished(int $published): void
    {
        $this->published = $published;
    }

    /**
     * @param int $access
     */
    public function setAccess(int $access): void
    {
        $this->access = $access;
    }

    /**
     * @param int $ordering
     */
    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }


}
