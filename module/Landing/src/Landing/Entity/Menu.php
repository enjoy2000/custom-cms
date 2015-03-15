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

    /*
     * @ORM\Column(type="boolean", options={"default" : 1})
     */
    protected $showMenu = 1;

    /**
     * @var \Landing\Entity\Menu
     * @ORM\ManyToOne(targetEntity="Landing\Entity\Menu")
     */
    protected $parentMenu = null;

    public function getId()
    {
        return $this->id;
    }
    
    public function getLabel()
    {
        return $this->label;
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

        return $menus;
    }

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
    
    public function hasChild($entityManager)
    {
        return (boolean) $this->getChildMenus($entityManager);
    }
    
    public function setData($data)
    {
        $keys = [
            'type',
            'value',
            'valueAr',
            'label',
            'labelAr',
            'orderNumber',
            'parentMenu',
            'showMenu',
        ];
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }
}
