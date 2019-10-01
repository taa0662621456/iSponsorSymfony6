<?php
	declare(strict_types=1);

	namespace App\Entity\Menu;

	use App\Entity\BaseTrait;
	use Doctrine\ORM\Mapping as ORM;

	/**
	 * @ORM\Table(name="menus_items", indexes={
	 * @ORM\Index(name="menus_items_slug", columns={"slug"})})
	 * @ORM\Entity
	 */
	class MenusItems
	{
		use BaseTrait;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_title", type="string", nullable=false, options={"comment"="The display title of
         *                                     the menu item."})
         */
		private $menuItemTitle = 'menu_item_title';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_path", type="string", nullable=false, options={"comment"="The computed path of
         *                                    the menu item based on the alias field."})
         */
		private $menuItemPath = '/';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="menu_item_display_type", type="string", nullable=false, options={"comment"="The displey
         *                                            type of : All page,  Not all, Exclude Page, Include page"})
         */
		private $menuItemDisplayType = '';

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="menu_item_published", type="boolean", nullable=false, options={"comment"="The published
         *                                         state of the menu link."})
         */
		private $menuItemPublished = 1;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="parent", type="integer", nullable=false, options={"default"="1","comment"="The parent menu
         *                            item in the menu tree."})
         */
		private $parent = '1';

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="children", type="integer", nullable=false, options={"default"="1","comment"="The parent
         *                              menu item in the menu tree."})
         */
		private $children = 1;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="role", type="integer", nullable=false, options={"comment"="The relative level in the
         *                          tree."})
         */
		private $role;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="home", type="boolean", nullable=false, options={"comment"="Indicates if this menu item is
         *                          the home or default page."})
         */
		private $home = '0';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="language", type="string", nullable=false, options={"default"=""})
		 */
		private $locale = '';
	}
