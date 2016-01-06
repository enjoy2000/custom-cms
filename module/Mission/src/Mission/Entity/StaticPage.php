<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 11:53.
 */
namespace Mission\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="StaticPage")
 */
class StaticPage
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
     * @ORM\Column(type="string",  length=255)
     */
    protected $urlKey;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $published = true;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $metaDescription = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $metaKeywords = null;

    /**
     * @var \Mission\Entity\Category
     * @ORM\ManyToOne(targetEntity="\Mission\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $category;

    /**
     * @var \Blog\Entity\Locale
     * @ORM\ManyToOne(targetEntity="\Blog\Entity\Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id", nullable=true)
     */
    protected $locale;

    /**
     * @var \User\Entity\User
     * @ORM\ManyToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="create_user_id", referencedColumnName="id", nullable=false)
     */
    protected $createUser;

    /**
     * @var \User\Entity\User
     * @ORM\ManyToOne(targetEntity="User\Entity\User")
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
     * @ORM\Column(type="integer", nullable=true, length=11)
     */
    protected $orderNumber = 0;

    public function preUpdate()
    {
        $this->updateTime = new \DateTime('now');
    }

    public function prePersist()
    {
        $this->createTime = new \DateTime('now');
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

    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Mission\Entity\Category $categories
     */
    public function setCategories($category)
    {
        $this->category = $category;
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
        return $this->createTime->format('Y-m-d H:i:s');
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
        return $this->updateTime->format('Y-m-d H:i:s');
    }

    /**
     * @param \DateTime $time
     */
    public function setUpdateTime($time)
    {
        $this->updateTime = $time;
    }

    public function togglePublished()
    {
        $this->published = !$this->published;
    }

    public function isPublished()
    {
        return (boolean) $this->published;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    public function getData()
    {
        $keys = [
            'id',
            'title',
            'urlKey',
            'published',
            'content',
            'metaDescription',
            'metaKeywords',
            'category',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime',
            'orderNumber',
        ];
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $this->$key;
        }

        return $data;
    }

    public function getFormData()
    {
        $data = $this->getData();
        $data['locale'] = $this->locale->getId();
        //var_dump($categories);die;
        $data['category'] = $this->category->getId();

        return $data;
    }

    public function setData($data)
    {
        $keys = [
            'title',
            'urlKey',
            'published',
            'content',
            'metaDescription',
            'metaKeywords',
            'category',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime',
            'orderNumber',
        ];
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }

        return $this;
    }

    public function getEditUrl()
    {
        return '/admin/mission-blog/edit/'.$this->id;
    }

    public function getDate($type = 'createTime')
    {
        return $this->$type->format('d/m/Y');
    }

    public function getUrl()
    {
        return '/'.self::BLOG_ROUTE.'/'.$this->urlKey;
    }

    public function getExactCreateTime()
    {
        return $this->createTime->format('jS F, Y  h:i A');
    }

    public function getOrder()
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrder($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }
}
