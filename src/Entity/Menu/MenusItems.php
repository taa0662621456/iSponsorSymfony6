<?php
	declare(strict_types=1);

	namespace App\Entity\Menu;

	use App\Entity\BaseTrait;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

	/**
	 * @ORM\Table(name="menus_items", indexes={
	 * @ORM\Index(name="menus_items_slug", columns={"slug"})})
	 * @UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
	 * @ORM\Entity
	 */
	class MenusItems
	{
		use BaseTrait;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_title", type="string", nullable=false, options={"comment"="The display title of the menu item."})
		 */
		private $menuItemTitle = 'menu_item_title';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_path", type="string", nullable=false, options={"comment"="The computed path of the menu item based on the alias field."})
		 */
		private $menuItemPath = '/';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_display_type", type="string", nullable=false, options={"comment"="The displey type of : All page,  Not all, Exclude Page, Include page"})
		 */
		private $menuItemDisplayType = '';

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="menu_item_published", type="boolean", nullable=false, options={"comment"="The published state of the menu link."})
		 */
		private $menuItemPublished = 1;

		/**
		 * @ORM\ManyToOne(targetEntity="App\Entity\Menu\MenusItems",
		 *     cascade={"persist"},
		 *     inversedBy="children")
		 */
		private $parent = '1';

		/**
		 * @ORM\OneToMany(targetEntity="App\Entity\Menu\MenusItems",
		 *     mappedBy="parent",
		 *     fetch="EXTRA_LAZY")
		 */
		private $children = 1;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="role", type="integer", nullable=false, options={"comment"="The relative level in the tree."})
		 */
		private $role;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="home", type="boolean", nullable=false, options={"comment"="Indicates if this menu item is the home or default page."})
		 */
		private $home = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="language", type="string", nullable=false, options={"default"=""})
		 */
		private $locale = '';

		/**
		 * @return string
		 */
		public function getMenuItemTitle(): string
		{
			return $this->menuItemTitle;
		}

		/**
		 * @param string $menuItemTitle
		 */
		public function setMenuItemTitle(string $menuItemTitle): void
		{
			$this->menuItemTitle = $menuItemTitle;
		}

		/**
		 * @return string
		 */
		public function getMenuItemPath(): string
		{
			return $this->menuItemPath;
		}

		/**
		 * @param string $menuItemPath
		 */
		public function setMenuItemPath(string $menuItemPath): void
		{
			$this->menuItemPath = $menuItemPath;
		}

		/**
		 * @return string
		 */
		public function getMenuItemDisplayType(): string
		{
			return $this->menuItemDisplayType;
		}

		/**
		 * @param string $menuItemDisplayType
		 */
		public function setMenuItemDisplayType(string $menuItemDisplayType): void
		{
			$this->menuItemDisplayType = $menuItemDisplayType;
		}

		/**
		 * @return bool
		 */
		public function isMenuItemPublished(): bool
		{
			return $this->menuItemPublished;
		}

		/**
		 * @param bool $menuItemPublished
		 */
		public function setMenuItemPublished(bool $menuItemPublished): void
		{
			$this->menuItemPublished = $menuItemPublished;
		}

		/**
		 * @return string
		 */
		public function getParent(): string
		{
			return $this->parent;
		}

		/**
		 * @param string $parent
		 */
		public function setParent(string $parent): void
		{
			$this->parent = $parent;
		}

		/**
		 * @return int
		 */
		public function getChildren(): int
		{
			return $this->children;
		}

		/**
		 * @param int $children
		 */
		public function setChildren(int $children): void
		{
			$this->children = $children;
		}

		/**
		 * @return int
		 */
		public function getRole(): int
		{
			return $this->role;
		}

		/**
		 * @param int $role
		 */
		public function setRole(int $role): void
		{
			$this->role = $role;
		}

		/**
		 * @return bool
		 */
		public function isHome(): bool
		{
			return $this->home;
		}

		/**
		 * @param bool $home
		 */
		public function setHome(bool $home): void
		{
			$this->home = $home;
		}

		/**
		 * @return string
		 */
		public function getLocale(): string
		{
			return $this->locale;
		}

		/**
		 * @param string $locale
		 */
		public function setLocale(string $locale): void
		{
			$this->locale = $locale;
		}


	}
