<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 11:08.
 */
namespace Mission\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="MissionBlog")
 */
class Blog
{
    const DEFAULT_UPLOAD_PATH = '/uploads/blog-photo/';
    const DEFAULT_CACHE_PATH = '/uploads/blog-photo/thumbnail/';
    const BLOG_ROUTE = 'mission';

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
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $photo = null;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $published = true;

    /**
     * @ORM\Column(type="text")
     */
    protected $shortContent;

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
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="Mission\Entity\Category")
     * @ORM\JoinTable(name="mission_blog_category",
     *      joinColumns={@ORM\JoinColumn(name="blog_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    protected $categories;

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
     * @ORM\Column(type="integer")
     */
    protected $views = 0;

    /**
     * Initialies the categories variable.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function preUpdate()
    {
        $this->updateTime = new \DateTime('now');
    }

    public function prePersist()
    {
        $this->createTime = new \DateTime('now');
    }

    public function getThumbnail()
    {
        $cacheImagePath = './public'.self::DEFAULT_CACHE_PATH.$this->photo;
        if (file_exists($cacheImagePath)) {
            return self::DEFAULT_CACHE_PATH.$this->photo;
        } else {
            return $this->getPhotoUrl();
        }
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
     * @param array $categories
     */
    public function setCategories(array $categories)
    {
        // remove old category
        $this->categories = [];
        foreach ($categories as $category) {
            $this->categories[] = $category;
        }
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photoPath)
    {
        $this->photo = $photoPath;
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

    public function getShortContent()
    {
        return $this->shortContent;
    }

    public function setShortContent($shortContent)
    {
        $this->shortContent = $shortContent;
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

    public function getViews()
    {
        return $this->views;
    }

    public function increaseViews()
    {
        $this->views = $this->views + 1;
    }

    public function getData()
    {
        $keys = [
            'id',
            'title',
            'urlKey',
            'published',
            'shortContent',
            'content',
            'metaDescription',
            'metaKeywords',
            'photo',
            'categories',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime',
            'views',
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
        $categories = [];
        foreach ($this->getCategories() as $cat) {
            $categories[] = $cat->getId();
        }
        //var_dump($categories);die;
        $data['categories'] = $categories;

        $unsetKeys = [
            'createUser',
            'createTime',
        ];

        return $data;
    }

    public function setData($data)
    {
        $keys = [
            'title',
            'urlKey',
            'published',
            'shortContent',
            'content',
            'metaDescription',
            'metaKeywords',
            'photo',
            'categories',
            'locale',
            'createUser',
            'createTime',
            'updateUser',
            'updateTime',
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

    public function renderPhoto()
    {
        $html = '';
        $html .= '<a class="news-photo" href="'.$this->getUrl()
                .'" title="'.$this->title.'">';
        $html .= '<img src="'.$this->getThumbnail().'" alt="" />';
        $html .= '</a>';

        return $html;
    }

    public function getExactCreateTime()
    {
        return $this->createTime->format('jS F, Y  h:i A');
    }

    public function getPhotoUrl()
    {
        return self::DEFAULT_UPLOAD_PATH.$this->photo;
    }
}
