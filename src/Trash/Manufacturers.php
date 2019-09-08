<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Manufacturers
 *
 * @ORM\Table(name="manufacturers")
 * ORM\UniqueConstraint(name="manufacturercategories_id", columns={"manufacturer_id", "manufacturercategories_id"})}, indexes={
 * ORM\Index(name="published", columns={"published"})})
 * @ORM\Entity
 */
class Manufacturers
{
    /**
     * @var int
     *
     * @ORM\Column(name="manufacturer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="manufacturer_categories_id", type="integer", nullable=true, options={"default":0})
     */
    private $ManufacturerCategoriesId = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metarobot", type="string", nullable=true, options={"default"="0"})
     */
    private $metarobot = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="metaauthor", type="string", nullable=true, options={"default":0})
     */
    private $metaauthor = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false, options={"default"="1"})
     */
    private $published = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false)
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="App\Entity\ManufacturesEnGb", mappedBy="manufacturesEnGb")
     */
    private $manufactureEnGb;










    /**
     * Manufacturers constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->createdOn = new \DateTime();
    }


}


