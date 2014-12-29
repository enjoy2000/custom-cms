<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 11:08
 */

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */
class Blog
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=255)
     */
    protected $urlKey;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $published = true;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Category")
     * @ORM\JoinTable(name="blog_category",
     *      joinColumns={@ORM\JoinColumn(name="blog_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $categories;

    /**
     * @var \Blog\Entity\Locale
     * @ORM\OneToOne(targetEntity="Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id", nullable=true)
     */
    protected $locale;

    /**
     * @var \User\Entity\User
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="create_user_id", referencedColumnName="id", nullable=false)
     */
    protected $createUser;

    /**
     * @var \User\Entity\User
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="update_user_id", referencedColumnName="id", nullable=true)
     */
    protected $updateUser;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updateTime;

    /**
     * Initialies the categories variable.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setUrlKey($urlKey)
    {
        $this->urlKey = $urlKey;
    }

    public function getUrlKey()
    {
        return $this->urlKey;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCategories()
    {
        return $this->categories->getValues();
    }

    /**
     * @param \Blog\Entity\Category $categories
     */
    public function setCategories(array $categories)
    {
        // remove old category
        $this->categories = [];
        foreach ($categories as $category) {
            $this->categories[] = $category;
        }
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

    public function getCreateUser()
    {
        return $this->createUser;
    }

    /**
     * @param \User\Entity\User $user
     */
    public function setCreateUser($user)
    {
        $this->createUser = $user;
    }

    public function getUpdateUser()
    {
        return $this->updateUser;
    }

    /**
     * @param \User\Entity\User $user
     */
    public function setUpdateUser($user)
    {
        $this->updateUser = $user;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param \DateTime $time
     */
    public function setCreateTime($time)
    {
        $this->createTime = $time;
    }

    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param \DateTime $time
     */
    public function setUpdateTime($time)
    {
        $this->updateTime = $time;
    }

    public function publish()
    {
        $this->published = true;
    }

    public function hide()
    {
        $this->published = false;
    }

    public function isPublished()
    {
        return (boolean) $this->published;
    }

    public function getData()
    {
        $keys = [
            'id',
            'title',
            'urlKey',
            'published',
            'content',
            'categories',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime'
        ];
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $this->$key;
        }

        return $data;
    }

    public function setData($data)
    {
        $keys = [
            'title',
            'urlKey',
            'published',
            'content',
            'categories',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime'
        ];
        foreach ($keys as $key) {
            $this->$key = $data[$key];
        }

        return $this;
    }
}