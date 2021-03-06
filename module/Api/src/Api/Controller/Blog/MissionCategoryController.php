<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 15:10.
 */
namespace Api\Controller\Blog;

use Api\Controller\AbstractRestfulJsonController;
use Application\Helper\Util;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Mission\Entity\Category;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;

class MissionCategoryController extends AbstractRestfulJsonController
{
    public function getList()
    {
        // create pager
        $em = $this->getEntityManager();
        $categories = $em->getRepository('Mission\Entity\Category');
        $queryBuilder = $categories->createQueryBuilder('c');

        // start filter
        if ($localeId = $this->params()->fromQuery('locale')) {
            $queryBuilder
                ->innerJoin('\Blog\Entity\Locale', 'l')
                ->where('c.locale=l.id')
                ->andWhere('l.id=:id')
                ->setParameter(':id', (int) $localeId);
        }
        $cats = $queryBuilder->getQuery()->getResult();
        $data = [];
        /**
         * @var \Mission\Entity\Category
         */
        foreach ($cats as $cat) {
            $data[] = $cat->getData();
        }

        /*
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int)$this->getRequest()->getQuery('page');
        if($page) $paginator->setCurrentPageNumber($page);
        $data = array();

        // var_dump($paginator);die;

        foreach($paginator as $category){
            $categoryData = $category->getData();
            $data[] = $categoryData;
        }
        */
        //var_dump($paginator);die;
        return new JsonModel([
            'categories' => $data,
        ]);
    }

    public function get($id)
    {
        $category = $this->find('Mission\Entity\Category', $id);

        return new JsonModel([
            'category' => $category,
        ]);
    }

    public function create($data)
    {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action'     => 'login',
            ]);
        }
        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $category = new Category();

        // get locale
        $data['locale'] = $this->find('Blog\Entity\Locale', (int) $data['locale']);

        if (!$data['urlKey']) {
            $slug = Util::slugify($data['name']);

            // check slug exist
            $slugExist = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $slug]);
            if ($slugExist) {
                $slug .= '-'.date('Ymdhis');
            }
            $data['urlKey'] = $slug;
        } else {
            $data['urlKey'] = Util::slugify($data['urlKey']);
            // check slug exist
            $slugExist = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $data['urlKey']]);
            if ($slugExist) {
                $data['urlKey'] .= '-'.date('Ymdhis');
            }
        }

        $category->setData($data);
        $em->persist($category);
        $em->flush();

        return new JsonModel([
            'success' => true,
        ]);
    }

    public function update($id, $data)
    {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action'     => 'login',
            ]);
        }

        // get data for update
        $user = $this->getCurrentUser();

        $em = $this->getEntityManager();
        $category = $this->find('Mission\Entity\Category', $id);

        // update moderators
        if ($data['updateMods']) {
            $arrModEntities = [];
            foreach ($data['updateMods'] as $modId) {
                $arrModEntities[] = $this->find('User\Entity\User', (int) $modId);
            }
            $category->setModerators($arrModEntities);
            $em->merge($category);
            $em->flush();

            return new JsonModel([
                'category' => $category->getData(),
            ]);
        }

        if ($data['urlKey']) {
            // check slug exist
            $slugExist = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $data['urlKey']]);
            if ($slugExist) {
                $data['urlKey'] .= '-'.date('Ymdhis');
            }
        }

        // get locale
        if ($data['locale']) {
            $data['locale'] = $this->find('Blog\Entity\Locale', (int) $data['locale']);
        }

        $category->setData($data);
        $category->setUpdateUser($user);
        $em->merge($category);
        $em->flush();

        return new JsonModel([
            'category' => $category->getData(),
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        if (!$this->isAdmin()) {
            return $this->redirect()->toRoute('zfcuser', [
                'controller' => 'user',
                'action'     => 'login',
            ]);
        }
        $em = $this->getEntityManager();

        /*
         * Remove check foreign key for temp delete category
         * If we need to remove blogs belong to this category as well, remove the this
         */
        $em->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

        $category = $this->find('Mission\Entity\Category', $id);
        $em->remove($category);
        $em->flush();
        // set foreign key check again for some security
        $em->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');

        return new JsonModel([
            'success' => true,
        ]);
    }
}
