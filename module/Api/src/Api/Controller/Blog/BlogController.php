<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 15:10
 */
namespace Api\Controller\Blog;

use Api\Controller\AbstractRestfulJsonController;
use Blog\Entity\Blog;
use Zend\View\Model\JsonModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Session\Container;

class BlogController extends AbstractRestfulJsonController
{

    public function getList()
    {
        // create pager
        $em = $this->getEntityManager();
        $blogs = $em->getRepository('Blog\Entity\Blog');
        $queryBuilder = $blogs->createQueryBuilder('blog');

        // start filter
        if ($localeCode = $this->params()->fromQuery('locale')) {
            $locale = $this->findOneBy('Blog\Entity\Locale', ['name' => $localeCode]);
            $queryBuilder->andWhere('blog.locale_id = ' . $locale->getId());
        }
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int)$this->getRequest()->getQuery('page');
        if($page) $paginator->setCurrentPageNumber($page);
        $data = array();

        foreach($paginator as $blog){
            $blogData = $blog->getData();
            $data[] = $blogData;
        }
        //var_dump($paginator);die;
        return new JsonModel(array(
            'blogs' => $data,
            'pages' => $paginator->getPages()
        ));
    }

    public function get($id)
    {

    }
}