<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Landing\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $localeSession = new Container('locale');
        $locale = $this->findBy('Blog\Entity\Locale', ['code' => $localeSession->locale]);
        $blogs = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->findBy(
                ['published' => true, 'locale' => $locale],
                ['id' => 'DESC'],
                10,
                0
            );

        $otherNews = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->findBy(
                ['published' => true, 'locale' => $locale],
                ['id' => 'DESC'],
                4,
                10
            );


        $restNews = $this->getEntityManager()->getRepository('Blog\Entity\Blog')
            ->findBy(
                ['published' => true, 'locale' => $locale],
                ['id' => 'DESC'],
                5,
                14
            );

        return new ViewModel([
            'blogs' => array_chunk($blogs, 2),  // chunk array for render in news
            'otherNews' => $otherNews,
            'restNews' => $restNews,
        ]);
    }
}
