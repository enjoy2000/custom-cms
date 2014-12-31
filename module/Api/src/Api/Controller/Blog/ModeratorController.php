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
use Doctrine\ORM\Query\Expr\Join;

class ModeratorController extends AbstractRestfulJsonController
{

    public function getList()
    {
        $em = $this->getEntityManager();
        $users = $em->getRepository('User\Entity\User');

        $queryBuilder = $users->createQueryBuilder('user');
        $mods  = $queryBuilder
                    ->innerJoin('user.roles', 'r')
                    ->where("r.roleId='administrator'")
                    ->getQuery()
                    ->getResult();
        $data = [];
        foreach ($mods as $mod) {
            $data[] = $mod->getData();
        }
        return new JsonModel([
            'moderators' => $data,
        ]);
    }
}