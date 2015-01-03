<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59
 */

namespace Blog\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Entity\Blog;

class BlogController extends AbstractActionController {
    public function indexAction()
    {
        return new ViewModel();
    }
}