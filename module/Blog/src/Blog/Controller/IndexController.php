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
use Zend\Session\Container;

class IndexController extends AbstractActionController {
    public function indexAction()
    {
        $locale = new Container('locale');
        $locale = $this->findOneBy('Blog\Entity\Locale', ['code' => $locale->locale]);

        // get categories based on current locale
        $repository = $this->getEntityManager()->getRepository('Blog\Entity\Category');
        $categories = $repository->findBy(
                        ['locale' => $locale],
                        ['name' => 'ASC']
        );

        return new ViewModel([
            'categories' => $categories
        ]);
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