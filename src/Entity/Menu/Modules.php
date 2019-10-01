<?php


	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Vq5bwModules
	 *
	 * @ORM\Table(name="vq5bw_modules", indexes={@ORM\Index(name="idx_language", columns={"language"}),
	 *                                  @ORM\Index(name="newsfeeds", columns={"module", "published"}),
	 *                                                               @ORM\Index(name="published", columns={"published",
	 *                                                                                            "access"})})
	 * @ORM\Entity
	 */
	class Vq5bwModules
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
		 * @ORM\Column(name="asset_id", type="integer", nullable=false, options={"comment"="FK to the #__assets
         *                              table."})
         */
		private $assetId = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="title", type="string", nullable=false, options={"default"="''"})
		 */
		private $title = '\'\'';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="note", type="string", nullable=false, options={"default"="''"})
		 */
		private $note = '\'\'';

		/**
		 * @var text
		 *
		 * @ORM\Column(name="content", type="text", nullable=false, options={"default"="''"})
		 */
		private $content = '\'\'';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="ordering", type="integer", nullable=false)
		 */
		private $ordering = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="position", type="string", nullable=false, options={"default"="''"})
		 */
		private $position = '\'\'';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="checked_out", type="integer", nullable=false)
		 */
		private $checkedOut = '0';

		/**
		 * @var datetime
		 *
		 * @ORM\Column(name="checked_out_time", type="datetime", nullable=false,
		 *                                      options={"default":"CURRENT_TIMESTAMP"})
		 */
		private $checkedOutTime = '\'0000-00-00 00:00:00\'';

		/**
		 * @var datetime
		 *
		 * @ORM\Column(name="publish_up", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 */
		private $publishUp = '\'0000-00-00 00:00:00\'';

		/**
		 * @var datetime
		 *
		 * @ORM\Column(name="publish_down", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 */
		private $publishDown = '\'0000-00-00 00:00:00\'';

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="published", type="boolean", nullable=false)
		 */
		private $published = '0';

		/**
		 * @var string|null
		 *
		 * @ORM\Column(name="module", type="string", nullable=true, options={"default":0})
		 */
		private $module = '0';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="access", type="integer", nullable=false)
		 */
		private $access = '0';

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="showtitle", type="boolean", nullable=false, options={"default"="1"})
		 */
		private $showtitle = '1';

		/**
		 * @var text
		 *
		 * @ORM\Column(name="params", type="text", nullable=false)
		 */
		private $params;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="client_id", type="boolean", nullable=false)
		 */
		private $clientId = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="language", type="string", nullable=false)
		 */
		private $language;


	}
