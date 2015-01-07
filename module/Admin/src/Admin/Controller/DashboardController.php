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

class DashboardController extends AbstractActionController
{
    public function indexAction()
    {
        // clone category
        $em = $this->getEntityManager();
        $qb = $em->getRepository('Blog\Entity\Category')
                        ->createQueryBuilder('c');
        $qb->andWhere($qb->expr()->gt('id', 8));
        $categories = $qb->getQuery()->getResult();
        foreach ($categories as $cat) {
            $cat2 = new \Blog\Entity\Category();
            $cat2->setData([
                'name' => $cat->getName(),
                'locale' => $this->find('Blog\Entity\Locale', 1),
                'urlKey' => 'random' . $cat->getId()
            ]);
            $em->persist($cat2);
            $em->flush();
            echo 'Finished clone category ' . $cat->getId() . '<br />';
        }
        echo 'finished all';die;
        if (!$this->getCurrentUser()) {
            return $this->redirect()->toUrl('/user/login?redirect=/admin');
        }
        return new ViewModel();
    }
}
