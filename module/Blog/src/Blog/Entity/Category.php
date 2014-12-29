<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 11:53
 */

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Category")
 */
class Category {
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var \Blog\Entity\Locale
     * @ORM\OneToOne(targetEntity="Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id", nullable=true)
     */
    protected $locale;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param \Blog\Entity\Locale $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}