<?php


	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Vq5bwMenuTypes
	 *
	 * @ORM\Table(name="vq5bw_menu_types", uniqueConstraints={@ORM\UniqueConstraint(name="idx_menutype", columns={"menutype"})})
	 * @ORM\Entity
	 */
	class Vq5bwMenuTypes
	{
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="id", type="integer", nullable=false)
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="IDENTITY")
		 */
		private $id;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="asset_id", type="integer", nullable=false)
		 */
		private $assetId = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menutype", type="string", nullable=false)
		 */
		private $menutype;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="title", type="string", nullable=false)
		 */
		private $title;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="description", type="string", nullable=false, options={"default"="''"})
		 */
		private $description = '\'\'';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="client_id", type="integer", nullable=false)
		 */
		private $clientId = '0';


	}
