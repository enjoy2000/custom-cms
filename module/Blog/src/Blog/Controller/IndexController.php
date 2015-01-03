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
use Zend\View\Model\JsonModel;
use Blog\Entity\Blog;

class IndexController extends AbstractActionController {
    public function indexAction()
    {
        return new ViewModel();
    }
    public function newsTickerAction()
    {
        $blogs = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
                            ->findBy(
                                ['published' => true],
                                ['id' => 'DESC'],
                                10,
                                0
                            );
        $newsTickers = '';
        /** @var \Blog\Entity\Blog $blog */
        foreach ($blogs as $blog) {
            $newsTickers .= '<li><a href="'
                            . $blog->getUrl() . '">'
                            . $blog->getTitle() . '</a> <span class="date">'
                            . $blog->getDate()
                            . '</span></li>';
        }
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($newsTickers);
        return $response;
    }
}