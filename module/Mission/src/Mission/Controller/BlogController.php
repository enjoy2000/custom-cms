<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59
 */

namespace Mission\Controller;

use Application\Controller\AbstractActionController;
use Doctrine\DBAL\Schema\View;
use Zend\View\Model\ViewModel;
use Mission\Entity\Blog;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;


class BlogController extends AbstractActionController {

    public function viewAction()
    {
        $slug = $this->params()->fromRoute('slug');
        $staticUrlKey = $this->params()->fromRoute('static');
        $category = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $slug]);

        if ($staticUrlKey) {
            $em = $this->getEntityManager();
            $qb = $em->getRepository('Mission\Entity\StaticPage')->createQueryBuilder('sp');
            $qb->andwhere($qb->expr()->eq('sp.category', $category->getId()))
                ->andWhere($qb->expr()->eq('sp.urlKey', "'".$staticUrlKey."'"));
            $staticPage  = $qb->getQuery()->getResult();
            //var_dump($staticPage[0]);die;
            if (is_array($staticPage) && isset($staticPage[0])) {
                return $this->forward()->dispatch('Mission\Controller\Blog', array(
                    'action' => 'static',
                    'staticPage'   => $staticPage[0],
                ));
            }
        }

        /** @var \Mission\Entity\Blog $blog */
        $blog = $this->findOneBy('Mission\Entity\Blog', ['urlKey' => $slug]);
        //var_dump($slug);die;
        if ($category) {
            return $this->forward()->dispatch('Mission\Controller\Blog', array(
                'action' => 'category',
                'category'   => $category
            ));
        } else {
            if ($blog) {
                // increase blog view
                $blog->increaseViews();
                $this->getEntityManager()->merge($blog);
                $this->getEntityManager()->flush();

                return $this->forward()->dispatch('Mission\Controller\Blog', array(
                    'action' => 'article',
                    'blog'   => $blog
                ));
            } else {
                $this->flashMessenger()->addErrorMessage($this->getTranslator()
                    ->translate('Your link is expired or that news does not exist anymore.'));

                return $this->redirect()->toRoute('blog');
            }
        }
    }

    public function articleAction()
    {
        $blog = $this->params()->fromRoute('blog');

        if ($this->params()->fromQuery('print') == 1) {
            $this->layout('layout/print');
        }

        return new ViewModel([
            'blog' => $blog
        ]);
    }

    public function categoryAction()
    {
        $category = $this->params()->fromRoute('category');

        $queryBuilder = $category->getActiveBlogs($this);

        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(\Mission\Entity\Category::BLOGS_PER_PAGE);

        $page = (int)$this->getRequest()->getQuery('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return new ViewModel([
            'category' => $category,
            'paginator' => $paginator,
        ]);
    }

    public function staticAction()
    {
        //$this->layout('layout/3columns');

        $staticPage = $this->params()->fromRoute('staticPage');

        return new ViewModel([
            'staticPage' => $staticPage
        ]);
    }
}