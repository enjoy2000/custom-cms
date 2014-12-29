<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 15:10
 */
namespace Api\Controller\Category;

use Api\Controller\AbstractRestfulJsonController;
use Blog\Entity\Category;
use Zend\View\Model\JsonModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Session\Container;

class CategoryController extends AbstractRestfulJsonController
{

    public function getList()
    {
        // create pager
        $em = $this->getEntityManager();
        $categories = $em->getRepository('Blog\Entity\Category');
        $queryBuilder = $categories->createQueryBuilder('Category');

        // start filter
        if ($localeCode = $this->params()->fromQuery('locale')) {
            $locale = $this->findOneBy('Blog\Entity\Locale', ['name' => $localeCode]);
            $queryBuilder->andWhere('Category.locale_id = ' . $locale->getId());
        }
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int)$this->getRequest()->getQuery('page');
        if($page) $paginator->setCurrentPageNumber($page);
        $data = array();

        foreach($paginator as $category){
            $categoryData = $category->getData();
            $data[] = $categoryData;
        }
        //var_dump($paginator);die;
        return new JsonModel([
            'categories' => $data,
            'pages' => $paginator->getPages()
        ]);
    }

    public function get($id)
    {
        $category = $this->find('Blog\Entity\Category', $id);

        return new JsonModel([
            'category' => $category
        ]);
    }

    public function create($data)
    {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action' => 'login'
            ]);
        }
        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $category = new Category();
        $category->setData($category);
        $category->setCreateUser($user);
        $em->persist($category);
        $em->flush();

        return new JsonModel([
            'category' => $category
        ]);
    }

    public function update($id, $data)
    {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action' => 'login'
            ]);
        }
        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $category = $this->find('Blog\Entity\Category', $id);
        $category->setData($data);
        $category->setUpdateUser($user);
        $em->merge($category);
        $em->flush();

        return new JsonModel([
            'category' => $category
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id) {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action' => 'login'
            ]);
        }
        $em = $this->getEntityManager();
        $category = $this->find('Blog\Entity\Category', $id);
        $em->remove($category);
        $em->flush();

        return new JsonModel([
        ]);
    }
}