<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 30/12/2014
 * Time: 11:46
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Form\BlogForm;
use Blog\Entity\Blog;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class BlogController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();

        $blogs = $em->getRepository('Blog\Entity\Blog');
        $queryBuilder = $blogs->createQueryBuilder('b');

        if (!$this->getCurrentUser() || !$this->getCurrentUser()->isModeratorOrAdmin()) {
            $queryBuilder->andWhere('blog.published=true');
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

        //var_dump($paginator);die;
        return new ViewModel([
            'paginator' => $paginator
        ]);
    }

    public function newAction()
    {
        $form = new BlogForm($this);

        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            //var_dump($data);die;
            // Make certain to merge the files info!
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($postData);
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('You news is created successfully!');
                return $this->redirect()->toRoute('zfcadmin/blog');
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $blog = $this->find('Blog\Entity\Blog', $id);
        $em = $this->getEntityManager();

        $form = new BlogForm($this);
        $form->getInputFilter()->remove('photo');
        $form->setData($blog->getFormData());

        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            //var_dump($data);die;
            // Make certain to merge the files info!
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($postData);
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('You news is updated successfully!');
                return $this->redirect()->toRoute('zfcadmin/blog');
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
        $dump = $this->find('Blog\Entity\Blog', 1);
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
