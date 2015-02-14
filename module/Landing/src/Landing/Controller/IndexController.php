<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Landing\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Blog\Entity\Category;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $localeSession = new Container('locale');
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $localeSession->locale]);

        $catUrlKey = ($locale->getShortCode() == 'en') ? Category::NEWS_EN : Category::NEWS_AR;
        $category = $this->getEntityManager()->getRepository('Blog\Entity\Category')
            ->findOneBy(
                ['urlKey' => $catUrlKey]
            )
        ;

        $qb = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->createQueryBuilder('b');
        $blogs = $qb->join('b.categories', 'c')
            ->where("c.urlKey = '{$catUrlKey}'")
            ->andWhere("b.published = 1")
            ->setFirstResult(0)
            ->setMaxResults(8)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();

        /*
        $otherNews = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->findBy(
                ['published' => true, 'locale' => $locale],
                ['id' => 'DESC'],
                4,
                10
            );
        */

        $qb = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->createQueryBuilder('b');
        $restNews = $qb->join('b.categories', 'c')
            ->where("c.urlKey = '{$catUrlKey}'")
            ->andWhere("b.published = 1")
            ->setFirstResult(8)
            ->setMaxResults(10)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();

        $this->layout('layout/layout');

        return new ViewModel([
            'blogs' => array_chunk($blogs, 2),  // chunk array for render in news
            //'otherNews' => $otherNews,
            'restNews' => $restNews,
        ]);
    }
}
