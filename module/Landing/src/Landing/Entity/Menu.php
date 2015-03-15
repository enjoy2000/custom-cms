<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 12:07
 */

namespace Landing\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Menu")
 */
class Menu {
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", columnDefinition="ENUM('article', 'category', 'static', 'external')") */
    protected $type;

    /**
     * @ORM\Column(type="string")
     */
    protected $label;

    /**
     * @ORM\Column(type="string")
     */
    protected $labelAr;

    /**
     * @ORM\Column(type="string")
     */
    protected $value;

    /**
     * @ORM\Column(type="string")
     */
    protected $valueAr;

    /**
     * @ORM\Column(type="integer")
     */
    protected $orderNumber = null;

    /**
<<<<<<< HEAD
=======
     * @ORM\Column(type="boolean")
     */
    protected $showMenu = 1;

    /**
>>>>>>> 5423a0b89b5883265adea0039a541b411bc0aa94
     * @var \Landing\Entity\Menu
     * @ORM\ManyToOne(targetEntity="Landing\Entity\Menu")
     */
    protected $parentMenu = null;

    public function getId()
    {
        return $this->id;
    }

    public function getMenu($localeShortCode)
    {
        $menu = ['type' => $this->type];
        if ($localeShortCode == 'en') {
            $menu['link'] = $this->value;
            $menu['label'] = $this->label;
        } else {
            $menu['link'] = $this->valueAr;
            $menu['label'] = $this->labelAr;
        }

        return $menu;
    }

    public function getType()
    {
        return $this->type;
    }

<<<<<<< HEAD
    public function getChildMenus($entityManager)
    {
        $menus = $entityManager->getRepository('Landing\Entity\Menu')->findBy(['parentMenu' => $this->id]);
=======
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    public function getShowMenu()
    {
        return $this->showMenu;
    }

    public function getChildMenus($entityManager)
    {
        $menus = $entityManager->getRepository('Landing\Entity\Menu')->findBy(['parentMenu' => $this->id]);
        $menus = $this->sortByOrderNumber($menus);
>>>>>>> 5423a0b89b5883265adea0039a541b411bc0aa94

        return $menus;
    }

<<<<<<< HEAD
=======
    public static function sortByOrderNumber($menus)
    {
        $sortedMenus = [];
        foreach ($menus as $menu)
        {
            $sortedMenus[$menu->getOrderNumber()] = $menu;
        }
        ksort($sortedMenus);

        return $sortedMenus;
    }

>>>>>>> 5423a0b89b5883265adea0039a541b411bc0aa94
    public function hasChild($entityManager)
    {
        return (boolean) $this->getChildMenus($entityManager);
    }
}