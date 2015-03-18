<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/2/15
 * Time: 7:07 PM
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Admin\Form\Menu;

class MenuController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([]);
    }

    public function newAction()
    {
        $form = new Menu($this, 'new');
        
        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            // Make certain to merge the files info!
            $postData = $request->getPost();
            $form->setData($postData->toArray());
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('Your menu has been created successfully!');
                return $this->redirect()->toRoute('zfcadmin/menu');
            }
        }
        
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $menu = $this->find('Landing\Entity\Menu', $id);
        if (!$menu) {
            $this->flashMessenger()->addErrorMessage('Cannot find your menu id!');
            return $this->redirect()->toRoute('zfcadmin/menu');
        }
        $form = new Menu($this, 'edit');
        $form->getInputFilter()->get('id')->setRequired(false);
        $form->setData($menu->getFormData());

        if ($this->getRequest()->isPost()) {
            /** @var \Zend\Http\Request $request */
            $request = $this->getRequest();
            // Make certain to merge the files info!
            $postData = $request->getPost();
            $form->setData($postData->toArray());
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('Your menu has been updated successfully!');
                return $this->redirect()->toRoute('zfcadmin/menu');
            }
        }

        return new ViewModel([
            'form' => $form,
            'title' => $menu->getLabel(),
        ]);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $menu = $this->find('Landing\Entity\Menu', $id);
        if (!$menu) {
            $this->flashMessenger()->addErrorMessage('Cannot find your menu id!');
            return $this->redirect()->toRoute('zfcadmin/menu');
        } else {
            $this->getEntityManager()->remove($menu);
            $this->getEntityManager()->flush();
            $this->flashMessenger()->addSuccessMessage('Your menu has been deleted successfully!');
            return $this->redirect()->toRoute('zfcadmin/menu');
        }
    }

    public function queryArticleAction()
    {
        $view = new ViewModel();
        $view->setTerminal(true);
        $query = $this->params()->fromQuery('s');
        //var_dump($query);die;

        $result = $this->getEntityManager()->getRepository('Blog\Entity\Blog')->createQueryBuilder('b')
            ->where("b.title LIKE :query")
            ->setParameter(':query', '%' . $query . '%')
            ->setMaxResults('10')
            ->getQuery()
            //->getSQL();
            ->getResult();
        //var_dump($result);die;
        $view->setVariable('result', $result);

        return $view;
    }

    public function queryCategoryAction()
    {
        $view = new ViewModel();
        $view->setTerminal(true);
        $query = $this->params()->fromQuery('s');
        //var_dump($query);die;

        $result = $this->getEntityManager()->getRepository('Blog\Entity\Category')->createQueryBuilder('c')
            ->where("c.name LIKE :query")
            ->setParameter(':query', '%' . $query . '%')
            ->setMaxResults('10')
            ->getQuery()
            //->getSQL();
            ->getResult();
        //var_dump($result);die;
        $view->setVariable('result', $result);

        return $view;
    }

    public function isParentMenuAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $menu = $this->find('Landing\Entity\Menu', $id);

        return new JsonModel([
            'result' => ($menu->getParentMenu() === null)
        ]);
    }
}