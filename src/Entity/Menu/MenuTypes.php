<?php


	use App\Entity\BaseTrait;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

	/**
	 * MenuTypes
	 *
	 * @ORM\Table(name="menu_types", indexes={
	 * @ORM\Index(name="menus_types_idx", columns={"slug"})})
	 * @UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
	 * @ORM\Entity
	 */
	class MenuTypes
	{

		use BaseTrait;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="asset_id", type="integer", nullable=false)
		 */
		private $assetId = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_type", type="string", nullable=false)
		 */
		private $menuType = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="title", type="string", nullable=false)
		 */
		private $title = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="description", type="string", nullable=false, options={"default"="''"})
		 */
		private $description = '';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="client_id", type="integer", nullable=false)
		 */
		private $clientId = 0;


	}
