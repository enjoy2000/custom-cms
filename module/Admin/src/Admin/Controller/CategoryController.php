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
use Zend\View\View;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        return new ViewModel();
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $category = $this->find('Blog\Entity\Category', $id);
        $em = $this->getEntityManager();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $data['locale'] = $this->find('Blog\Entity\Locale', (int)$data['locale']);

            // if new slug exist add unique id
            if ($category->getUrlKey() != $data['urlKey']) {
                $slugExist = $this->findOneBy('Blog\Entity\Category', ['urlKey' => $data['urlKey']]);
                if ($slugExist) {
                    $data['urlKey'] .= '-' . date('Ymdhis');
                }
            }

            $category->setData($data);
            $em->merge($category);
            $em->flush();

            return $this->redirect()->toRoute('zfcadmin/category');
        }

        $locales = $this->getEntityManager()->getRepository('Blog\Entity\Locale')->findAll();

        return new ViewModel([
            'category' => $category,
            'locales' => $locales
        ]);
    }
}
