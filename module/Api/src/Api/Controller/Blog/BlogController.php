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

class BlogController extends AbstractRestfulJsonController
{

    public function getList()
    {
        // create pager
        $em = $this->getEntityManager();
        $blogs = $em->getRepository('Blog\Entity\Blog');
        $queryBuilder = $blogs->createQueryBuilder('blog');

        if (!$this->getCurrentUser() || !$this->getCurrentUser()->isModeratorOrAdmin()) {
            $queryBuilder->andWhere('blog.published=1');
        }

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
        if ($page) $paginator->setCurrentPageNumber($page);
        $data = array();

        foreach($paginator as $blog){
            $blogData = $blog->getData();
            $data[] = $blogData;
        }
        //var_dump($paginator);die;
        return new JsonModel([
            'blogs' => $data,
            'pages' => $paginator->getPages()
        ]);
    }

    public function get($id)
    {
        $blog = $this->find('Blog\Entity\Blog', $id);

        return new JsonModel([
            'blog' => $blog
        ]);
    }

    public function create($data)
    {
        $this->checkPermissionForModerator($data['categories']);
        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $blog = new Blog();
        $blog->setData($data);
        $blog->setCreateUser($user);
        $em->persist($blog);
        $em->flush();

        return new JsonModel([
            'blog' => $blog
        ]);
    }

    public function update($id, $data)
    {
        $this->checkPermissionForModerator($data['categories']);
        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $blog = $this->find('Blog\Entity\Blog', $id);
        $blog->setData($data);
        $blog->setUpdateUser($user);
        $em->merge($blog);
        $em->flush();

        return new JsonModel([
            'blog' => $blog
        ]);
    }

    /**
     * Delete but we just toggle published variable
     * @param $id
     */
    public function delete($id) {
        $em = $this->getEntityManager();
        $blog = $this->find('Blog\Entity\Blog', $id);
        $this->checkPermissionForModerator($blog->getCategories());
        $blog->togglePublished();
        $em->merge($blog);
        $em->flush();

        return new JsonModel([
            'blog' => $blog
        ]);
    }
}