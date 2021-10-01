<?php

	namespace App\Entity\Module;

	use Doctrine\ORM\Mapping as ORM;

	/**
	 * ModulesMenu
	 *
	 * @ORM\Table(name="modules_menu")
	 * @ORM\Entity
	 */
	class ModulesMenu
	{
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="id", type="integer", nullable=false)
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="NONE")
		 */
		private $id = '0';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="menuid", type="integer", nullable=false)
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="NONE")
		 */
		private $menuId = '0';


	}
