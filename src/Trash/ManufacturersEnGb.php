<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * ManufacturersEnGb
 *
 * @ORM\Table(name="manufacturers_en_gb")
 * ORM\UniqueConstraint(name="slug", columns={"slug"})
 * @ORM\Entity
 */
class ManufacturersEnGb
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
     * @var string
     *
     * @ORM\Column(name="mf_name", type="string", nullable=false, options={"default"=""})
     */
    private $mfName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mf_desc", type="string", nullable=false, options={"default"=""})
     */
    private $mfDesc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="metadesc", type="string", nullable=false, options={"default"=""})
     */
    private $metadesc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="metakey", type="string", nullable=false, options={"default"=""})
     */
    private $metakey = '';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", nullable=false, options={"default"=""})
     */
    private $slug = '';

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Manufactures", cascade={"persist", "remove"}, inversedBy="", orphanRemoval=true)
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $manufactures;


}
