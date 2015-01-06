<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59
 */

namespace Blog\Controller;

use Application\Controller\AbstractActionController;
use Doctrine\DBAL\Schema\View;
use Zend\View\Model\ViewModel;
use Blog\Entity\Blog;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;


class BlogController extends AbstractActionController {

    public function viewAction()
    {
        $slug = $this->params()->fromRoute('slug');
        $category = $this->findOneBy('Blog\Entity\Category', ['urlKey' => $slug]);
        $blog = $this->findOneBy('Blog\Entity\Blog', ['urlKey' => $slug]);
        //var_dump($slug);die;
        if ($category) {
            return $this->forward()->dispatch('Blog\Controller\Blog', array(
                'action' => 'category',
                'category'   => $category
            ));
        } else {
            if ($blog) {
                return $this->forward()->dispatch('Blog\Controller\Blog', array(
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
        $paginator->setDefaultItemCountPerPage(\Blog\Entity\Category::BLOGS_PER_PAGE);

        $page = (int)$this->getRequest()->getQuery('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return new ViewModel([
            'category' => $category,
            'paginator' => $paginator,
        ]);
    }
}