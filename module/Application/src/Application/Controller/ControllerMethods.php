<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 9/27/14
 * Time: 10:28 PM
 */

namespace Application\Controller;

use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Session\Container;

use User\Entity\User;


trait ControllerMethods{
    
    protected $currentUser = null;

    protected $_entityManager = null;

    protected $_locale = null;

    /**
     * Dispatch a request
     *
     * @events dispatch.pre, dispatch.post
     * @param  Request $request
     * @param  null|Response $response
     * @return Response|mixed
     */
    public function dispatch(Request $request, Response $response = null){
        return parent::dispatch($request, $response);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        if($this->_entityManager === null){
            $this->_entityManager = $this->getServiceLocator()
                                         ->get('Doctrine\ORM\EntityManager');
        }
        return $this->_entityManager;
    }

    /**
     * Get current locale
     * @return string|null
     */
    public function getLocale()
    {
        if (null === $this->_locale) {
            $locale = new Container('locale');
            $this->_locale  = $locale->locale;
        }

        return $this->_locale;
    }

    /**
     * @param $entityName
     * @param $criteria
     * @return object
     */
    public function findOneBy($entityName, $criteria){
        return $this->getEntityManager()->getRepository($entityName)->findOneBy($criteria);
    }

    public function findBy($entityName, $criteria){
        return $this->getEntityManager()->getRepository($entityName)->findBy($criteria);
    }

    /**
     * @param $entityName
     * @param $id
     * @return object
     */
    public function find($entityName, $id){
        return $this->getEntityManager()->find($entityName, $id);
    }

    /**
     * @param $entityName
     * @param $id
     * @return object
     */
    public function getReference($entityName, $id){
        return $this->getEntityManager()->getReference($entityName, $id);
    }

    /**
     * @param $criteria
     * @return null|\User\Entity\User
     */
    public function getUser($criteria){
        return $this->getEntityManager()->getRepository('\User\Entity\User')->findOneBy($criteria);
    }

    /**
     * @param integer $id
     * @return null|\User\Entity\User
     */
    function getUserById($id){
        return $this->getEntityManager()->find('\User\Entity\User', $id);
    }

    /**
     * Get base url
     * @return string
     */
    public function getBaseUrl(){
        $uri = $this->getRequest()->getUri();
        $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
        return $base;
    }

    public function getTranslator(){
        return $this->getServiceLocator()->get('translator');
    }

    /**
     * @return null|\User\Entity\User
     */
    public function getCurrentUser(){
        if($this->currentUser === null){
            if ($this->zfcUserAuthentication()->hasIdentity()) {
                $this->currentUser = $this->zfcUserAuthentication()->getIdentity();
            }
        }
        return $this->currentUser;
    }

    /**
     * Check for user logged in permission is Moderator of list categories or admin
     */
    public function checkPermissionForModerator(array $categories)
    {
        if ($this->getCurrentUser()) {
            $roles = $this->getCurrentUser()->getRoles();
            foreach ($roles as $role) {
                $roleId = $role->getRoleId();
                if($roleId == 'administrator') {  // if admin return true
                    return true;
                } else if ($roleId == 'moderator') {  // if mod check if has permission in at least 1 category
                    foreach ($categories as $category) {
                        $mods = $category->getModerators();
                        if (in_array($this->getCurrentUser(), $mods)) {
                            return true;
                        }
                    }
                }
            }
        }

        return $this->redirect()->toRoute('zfcuser', [
            'controller' => 'user',
            'action' => 'login'
        ]);
    }

    /**
     * Check current user is admin or not
     */
    public function isAdmin()
    {
        return ($this->getCurrentUser()->getRoleId() == 'administrator');
    }
}