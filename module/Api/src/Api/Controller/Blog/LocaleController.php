<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 29/12/2014
 * Time: 15:10
 */
namespace Api\Controller\Blog;

use Api\Controller\AbstractRestfulJsonController;
use Zend\View\Model\JsonModel;

class LocaleController extends AbstractRestfulJsonController
{

    public function getList()
    {
        $em = $this->getEntityManager();
        $locales = $em->getRepository('Blog\Entity\Locale');
        //var_dump($locales);die;
        $data = [];
        foreach ($locales as $locale) {
            $data[] = $locale->getData();
        }

        return new JsonModel([
            'locales' => $data,
        ]);
    }
}