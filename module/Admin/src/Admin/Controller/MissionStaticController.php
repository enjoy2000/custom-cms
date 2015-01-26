<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 30/12/2014
 * Time: 11:46
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Doctrine\DBAL\Schema\View;
use Zend\View\Model\ViewModel;
use Mission\Form\StaticForm;
use Mission\Entity\StaticPage;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class MissionStaticController extends AbstractActionController
{
    public function indexAction()
    {
        $missionCategories = $this->getEntityManager()->getRepository('Mission\Entity\Category')->findAll();

        return new ViewModel([
            'categories' => $missionCategories,
        ]);
    }

    public function manageAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $category = $this->find('Mission\Entity\Category', $id);

        $em = $this->getEntityManager();

        $blogs = $em->getRepository('Mission\Entity\StaticPage');
        $queryBuilder = $blogs->createQueryBuilder('b');
        $queryBuilder->andWhere($queryBuilder->expr()->eq('b.category', $category->getId()));

        // start filter
        if ($localeCode = $this->params()->fromQuery('locale')) {
            $locale = $this->findOneBy('Blog\Entity\Locale', ['name' => $localeCode]);
            $queryBuilder->andWhere('b.locale = ' . $locale->getId());
        }

        // set order by blog id DESC
        $queryBuilder->orderBy('b.id', 'DESC');
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int)$this->getRequest()->getQuery('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        //var_dump($paginator);die;
        return new ViewModel([
            'category' => $category,
            'paginator' => $paginator
        ]);
    }

    public function newAction()
    {
        $form = new StaticForm($this);

        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            $postData = $request->getPost()->toArray();
            $form->setData($postData);
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('Your static page is created successfully!');
                return $this->redirect()->toRoute('zfcadmin/mission-category/static/manage', ['id' => $postData['category']]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $blog = $this->find('Mission\Entity\StaticPage', $id);
        $em = $this->getEntityManager();

        $form = new StaticForm($this);
        $form->setData($blog->getFormData());

        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            $postData = $request->getPost()->toArray();

            $form->setData($postData);
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('Your static page is updated successfully!');
                return $this->redirect()->toRoute('zfcadmin/mission-category/static/manage',['id' => $postData['category']]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function dumpAction()
    {
        $em = $this->getEntityManager();
        //
        $dump = $this->find('Mission\Entity\StaticPage', 1);
        $dumpData = $dump->getData();
        unset($dumpData['id']);
        for ($i = 0; $i < 50; ++$i) {
            $blog = new Blog;
            $dumpData['urlKey'] .= $i;
            $blog->setData($dumpData);
            $em->persist($blog);
            $em->flush();
            echo sprintf('Inserted %s rows successfully<br />', $i+1);
        }
        echo 'finished all';
        die;
    }
}
