<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 11:53
 */

namespace Mission\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="MissionCategory")
 */
class Category {

    const BLOGS_PER_PAGE = 5;

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
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $urlKey;

    /**
     * @var \Blog\Entity\Locale
     * @ORM\ManyToOne(targetEntity="\Blog\Entity\Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id", nullable=true)
     */
    protected $locale;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="User\Entity\User")
     * @ORM\JoinTable(name="mission_user_category",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $moderators;

    /**
     * @var \Mission\Entity\Category
     * @ORM\OneToOne(targetEntity="Mission\Entity\Category")
     */
    protected $category = null;

    public function __construct()
    {
        $this->moderators = new ArrayCollection();
    }

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

    public function setUrlKey($urlKey)
    {
        $this->urlKey = $urlKey;
    }

    public function getUrlKey()
    {
        return $this->urlKey;
    }

    public function getModerators()
    {
        return $this->moderators->getValues();
    }

    public function setModerators(array $moderators)
    {
        $this->moderators = $moderators;
    }

    public function getData()
    {
        $mods = $this->getModerators();
        $users = [];
        foreach ($mods as $mod) {
            $users[] = $mod->getData();
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'locale' => $this->locale->getData(),
            'urlKey' => $this->urlKey,
            'moderators' => $users,
            'category' => $this->category
        ];
    }

    public function setData($data)
    {
        $keys = [
            'name',
            'urlKey',
            'locale',
            'category'
        ];
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    public function getUrl()
    {
        $url = '/' . \Mission\Entity\Blog::BLOG_ROUTE . '/' .$this->urlKey;

        return $url;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(\Mission\Entity\Category $category)
    {
        $this->category = $category;
    }

    public function getActiveBlogs($controller) 
    {
        $em = $controller->getEntityManager();
        $qb = $em->getRepository('Mission\Entity\Blog')->createQueryBuilder('b');
        $queryBuilder  = $qb
                    ->innerJoin('b.categories', 'c')
                    ->where("c.id=" . $this->id)
                    ->orderBy('b.id', 'DESC');
        return $queryBuilder;
    }

    public function getChildPages($em)
    {
        $childPages = $em->getRepository('Mission\Entity\StaticPage')
            ->findBy(['category' => $this]);
        return $childPages;
    }
}