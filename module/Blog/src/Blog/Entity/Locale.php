<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 12:07.
 */
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Locale")
 */
class Locale
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $shortCode;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($localeCode)
    {
        $this->name = $localeCode;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($localeCode)
    {
        $this->code = $localeCode;
    }

    public function getShortCode()
    {
        return $this->shortCode;
    }

    public function setShortCode($localeCode)
    {
        $this->shortCode = $localeCode;
    }

    public function getData()
    {
        $keys = [
            'id',
            'code',
            'name',
            'shortCode',
        ];
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $this->$key;
        }

        return $data;
    }
}
