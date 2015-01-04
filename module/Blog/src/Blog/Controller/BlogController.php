<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 10:59
 */

namespace Blog\Controller;

use Application\Controller\AbstractActionController;
use Doctrine\DBAL\Schema\View;
use Zend\View\Model\ViewModel;
use Blog\Entity\Blog;

class BlogController extends AbstractActionController {

    public function viewAction()
    {
        $slug = $this->params()->fromRoute('slug');
        $category = $this->findOneBy('Blog\Entity\Category', ['urlKey' => $slug]);
        $blog = $this->findOneBy('Blog\Entity\Blog', ['urlKey' => $slug]);
        //var_dump($slug);die;
        if ($category) {
            return $this->forward()->dispatch('Blog\Controller\Blog', array(
                'action' => 'category',
                'category'   => $category
            ));
        } else {
            if ($blog) {
                return $this->forward()->dispatch('Blog\Controller\Blog', array(
                    'action' => 'article',
                    'blog'   => $blog
                ));
            } else {
                $this->flashMessenger()->addErrorMessage($this->getTranslator()
                    ->translate('Your link is expired or that news does not exist anymore.'));

                return $this->redirect()->toRoute('blog');
            }
        }
    }

    public function articleAction()
    {
        $blog = $this->params()->fromRoute('blog');

        return new ViewModel([
            'blog' => $blog
        ]);
    }

    public function categoryAction()
    {
        $category = $this->params()->fromRoute('category');

        return new ViewModel([
            'category' => $category
        ]);
    }
}