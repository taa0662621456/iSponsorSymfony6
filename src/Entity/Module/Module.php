<?php

	namespace App\Entity\Module;

	use Doctrine\ORM\Mapping as ORM;


    /**
	 * Modules
	 *
	 * @ORM\Table(name="modules")
	 * @ORM\Entity
	 */
	class Module
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
		 * @ORM\Column(name="asset_id", type="integer", nullable=false, options={"comment"="FK to the #__assets table."})
		 */
		private $assetId = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="title", type="string", nullable=false, options={"default"="''"})
		 */
		private $title = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="note", type="string", nullable=false, options={"default"="''"})
		 */
		private $note = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="content", type="text", nullable=false, options={"default"="''"})
		 */
		private $content = '';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="ordering", type="integer", nullable=false)
		 */
		private $ordering = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="position", type="string", nullable=false, options={"default"="''"})
		 */
		private $position = '';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="checked_out", type="integer", nullable=false)
		 */
		private $checkedOut = 0;

		/**
		 * @var string
		 * @ORM\Column(name="checked_out_time", type="string", nullable=false,
		 *                                      options={"default":"CURRENT_TIMESTAMP"})
		 */
		private string $checkedOutTime = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="publish_up", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 */
		private string $publishUp = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="publish_down", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 */
		private string $publishDown = '';

		/**
		 * @var string|null
		 *
		 * @ORM\Column(name="module", type="string", nullable=true, options={"default":0})
		 */
		private ?string $module = '0';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="access", type="integer", nullable=false)
		 */
		private int $access = 0;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="show_title", type="boolean", nullable=false, options={"default"="1"})
		 */
		private bool $showTitle = true;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="params", type="string", nullable=false)
		 */
		private string $params;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="client_id", type="boolean", nullable=false)
		 */
		private int|bool $clientId = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="language", type="string", nullable=false)
		 */
		private string $language;


	}
