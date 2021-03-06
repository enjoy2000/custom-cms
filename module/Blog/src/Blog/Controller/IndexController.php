<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59.
 */
namespace Blog\Controller;

use Application\Controller\AbstractActionController;
use Blog\Entity\Category;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $locale = new Container('locale');
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $locale->locale]);
        $catUrlKey = ($locale->getShortCode() == 'en') ? Category::NEWS_EN : Category::NEWS_AR;

        return $this->redirect()->toRoute('blog/view', ['slug' => $catUrlKey]);

        // get categories based on current locale
        $repository = $this->getEntityManager()->getRepository('Blog\Entity\Category');
        $categories = $repository->findBy(
                        ['locale' => $locale],
                        ['name' => 'ASC']
        );

        return new ViewModel([
            'categories' => $categories,
        ]);
    }

    public function newsTickerAction()
    {
        $locale = new Container('locale');
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $locale->locale]);
        $catUrlKey = ($locale->getShortCode() == 'en') ? Category::NEWS_EN : Category::NEWS_AR;
        $em = $this->getEntityManager();
        $qb = $em->getRepository('Blog\Entity\Blog')->createQueryBuilder('b');
        $qb
            ->join('b.categories', 'c')
            ->select('b')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('b.published', ':published'),
                //$qb->expr()->eq('b.locale', ':locale'),
                $qb->expr()->eq('c.urlKey', ':urlKey')
            ))
            ->setParameter('published', 1)
            //->setParameter('locale', $locale)
            ->setParameter('urlKey', $catUrlKey)
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(10)
            ->setFirstResult(0);
        $blogs = $qb->getQuery()->getResult();
        $newsTickers = '';
        /** @var \Blog\Entity\Blog $blog */
        foreach ($blogs as $blog) {
            $newsTickers .= '<li><a href="'
                            .$blog->getUrl().'">'
                            .$blog->getTitle().'</a> <span class="date">'
                            .$blog->getDate()
                            .'</span></li>';
        }
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($newsTickers);

        return $response;
    }

    public function latestNewsAction()
    {
        $localeSession = new Container('locale');
        /** @var \Blog\Entity\Locale $locale */
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $localeSession->locale]);
        if ($locale->getShortCode() == 'en') {
            $key = 'latest-news';
        } else {
            $key = 'latest-news-ar';
        }
        /** @var \Zend\Cache\Storage\Adapter\Redis $cache */
        $cache = $this->getServiceLocator()->get('Cache\Persistence');

        // TODO: removed cached already
        //if (!$cache->hasItem($key)) {
            $blogs = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
                ->findBy(
                    ['published' => 1, 'locale' => $locale],
                    ['id' => 'DESC'],
                    5,
                    0
                );

        $blogsData = [];
            /** @var \Blog\Entity\Blog $blog */
            foreach ($blogs as $blog) {
                $blogsData[] = [
                    'blogUrl'      => $blog->getUrl(),
                    'title'        => $blog->getTitle(),
                    'thumbnail'    => $blog->getThumbnail(),
                    'shortContent' => $blog->getShortContent(),
                ];
            }

        $cache->setItem($key, $blogsData);
        //}

        return new JsonModel([
            'blogs' => $cache->getItem($key),
        ]);
    }
}
