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

    public function iraqiAmbassadorsAction()
    {
        die('here');
        return $this->forward()->dispatch('Mission\Controller\Index', [
            'action' => 'index'
        ]);
    }
}