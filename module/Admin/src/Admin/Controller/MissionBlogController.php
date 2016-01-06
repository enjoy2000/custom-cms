<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 30/12/2014
 * Time: 11:46.
 */
namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Mission\Entity\Blog;
use Mission\Form\BlogForm;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

class MissionBlogController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();

        $blogs = $em->getRepository('Mission\Entity\Blog');
        $queryBuilder = $blogs->createQueryBuilder('b');

        // start filter
        if ($localeCode = $this->params()->fromQuery('locale')) {
            $locale = $this->findOneBy('Blog\Entity\Locale', ['name' => $localeCode]);
            $queryBuilder->andWhere('blog.locale_id = '.$locale->getId());
        }

        // set order by blog id DESC
        $queryBuilder->orderBy('b.id', 'DESC');
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int) $this->getRequest()->getQuery('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        //var_dump($paginator);die;
        return new ViewModel([
            'paginator' => $paginator,
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

                return $this->redirect()->toRoute('zfcadmin/mission-blog');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        $blog = $this->find('Mission\Entity\Blog', $id);
        $em = $this->getEntityManager();

        $form = new BlogForm($this);
        $form->getInputFilter()->get('photo')->setRequired(false);
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
            'form' => $form,
        ]);
    }
}
