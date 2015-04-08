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

        $qb1 = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->createQueryBuilder('b');
        $blogs = $qb1->innerJoin('b.categories', 'c')
            ->where("c.urlKey = :urlkey")
            ->setParameter(':urlkey', $catUrlKey)
            ->andWhere("b.published = :published")
            ->setParameter(':published', 1)
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
        $restNewsUrl = ($locale->getShortCode() == 'en') ?
            ['en-missions-news', 'eundersecretaries-news'] :
            ['ar-missions-news', 'aundersecretaries-news']
        ;
        $qb2 = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->createQueryBuilder('b');
        $restNews = $qb2->innerJoin('b.categories', 'c')
            ->where("b.published = :published")
            ->setParameter(':published', 1)
            ->andWhere("c.urlKey = '$restNewsUrl[0]' OR c.urlKey ='$restNewsUrl[1]'")
            ->setFirstResult(0)
            ->setMaxResults(10)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();
        
        
        $missionUrl = ($locale->getShortCode() == 'en') ? 'en-missions-news' : 'ar-missions-news';
        $qb3 = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->createQueryBuilder('b');
        $missionNews = $qb3->innerJoin('b.categories', 'c')
            ->where("b.published = :published")
            ->setParameter(':published', 1)
            ->andWhere("c.urlKey = '$missionUrl'")
            ->setFirstResult(0)
            ->setMaxResults(10)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();    

        $this->layout('layout/layout');

        return new ViewModel([
            'blogs' => $blogs,  // chunk array for render in news
            'missionNews' => $missionNews,
            'restNews' => $restNews,
        ]);
    }
}
