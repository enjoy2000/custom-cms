<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59
 */

namespace Mission\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController {
    public function indexAction()
    {
        $locale = new Container('locale');
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $locale->locale]);

        // get categories based on current locale
        $repository = $this->getEntityManager()->getRepository('Mission\Entity\Category');
        $categories = $repository->findBy(
                        ['locale' => $locale],
                        ['name' => 'ASC']
        );

        return new ViewModel([
            'categories' => $categories
        ]);
    }

    public function menuAction()
    {
        $categorySlug = $this->params()->fromQuery('category');
        $staticPageSlug = $this->params()->fromQuery('static');
        $category = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $categorySlug]);
        $childPages = $category->getChildPages($this->getEntityManager());

        $view = new ViewModel([
            'category' => $categorySlug,
            'static' => $staticPageSlug,
            'childPages' => $childPages
        ]);
        $view->setTerminal(true);
        return $view;
    }

    public function headerAction()
    {
        $categorySlug = $this->params()->fromQuery('category');
        $category = $this->findOneBy('Mission\Entity\Category', ['urlKey' => $categorySlug]);
        $view = new ViewModel([
            'header' => $category->getName()
        ]);
        $view->setTerminal(true);
        return $view;
    }
}