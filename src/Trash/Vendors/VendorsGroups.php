<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_group")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsGroupsRepository")
 */
class VendorsGroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Primary Key"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false, options={"comment"="Adjacency List Reference Id"})
     */
    private $parentId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lft", type="integer", nullable=false, options={"comment"="Nested set lft."})
     */
    private $lft = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rgt", type="integer", nullable=false, options={"comment"="Nested set rgt."})
     */
    private $rgt = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false, options={"default"="''"})
     */
    private $title = '\'\'';


}
