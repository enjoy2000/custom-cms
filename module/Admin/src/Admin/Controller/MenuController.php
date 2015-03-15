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
            $postData = $request->getPost()->toArray();
            $form->setData($postData);
            if ($form->isValid()) {
                $form->save($this);
                $this->flashMessenger()->addSuccessMessage('Your menu is created successfully!');
                return $this->redirect()->toRoute('zfcadmin/menu');
            }
        }
        
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        return new ViewModel([

        ]);
    }

    public function deleteAction()
    {
        return new ViewModel([

        ]);
    }
}