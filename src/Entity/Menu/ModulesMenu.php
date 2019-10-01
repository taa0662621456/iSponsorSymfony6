<?php


	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Vq5bwModulesMenu
	 *
	 * @ORM\Table(name="vq5bw_modules_menu")
	 * @ORM\Entity
	 */
	class Vq5bwModulesMenu
	{
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="moduleid", type="integer", nullable=false)
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="NONE")
		 */
		private $moduleid = '0';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="menuid", type="integer", nullable=false)
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="NONE")
		 */
		private $menuid = '0';


	}
