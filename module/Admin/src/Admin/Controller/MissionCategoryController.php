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
use Application\Helper\Util;

class MissionCategoryController extends AbstractActionController
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
        $category = $this->find('Mission\Entity\Category', $id);
        $em = $this->getEntityManager();

        // get arabic categories
        $arLocale = $this->find('Blog\Entity\Locale', 2);
        $arCategories = $this->findBy('Mission\Entity\Category', ['locale' => $arLocale]);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $data['locale'] = $this->find('Blog\Entity\Locale', (int)$data['locale']);
            $data['category'] = $this->find('Mission\Entity\Category', (int)$data['category']);

            // if new slug exist add unique id
            if ($category->getUrlKey() != $data['urlKey']) {
		$data['urlKey'] = Util::slugify($data['urlKey']);
                $slugExist = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $data['urlKey']]);
                if ($slugExist) {
                    $data['urlKey'] .= '-' . date('Ymdhis');
                }
            }

            $category->setData($data);
            $em->merge($category);
            $em->flush();

            return $this->redirect()->toRoute('zfcadmin/mission-category');
        }

        $locales = $this->getEntityManager()->getRepository('Blog\Entity\Locale')->findAll();

        return new ViewModel([
            'category' => $category,
            'locales' => $locales,
            'arCategories' => $arCategories
        ]);
    }
}
