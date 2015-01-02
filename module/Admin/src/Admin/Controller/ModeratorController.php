<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/2/15
 * Time: 7:07 PM
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use ZfcUser\Controller\UserController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use ZfcUser\Service\User as UserService;
use ZfcUser\Options\UserControllerOptionsInterface;

class ModeratorController extends UserController
{
    public function __construct()
    {

    }

    public function registerAction()
    {
        $request = $this->getRequest();
        $service = $this->getUserService();
        $form = $this->getRegisterForm();

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }

        $redirectUrl = $this->url()->fromRoute('zfcadmin/moderator/create')
            . ($redirect ? '?redirect=' . rawurlencode($redirect) : '');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }

        $post = $prg;
        /** @var \User\Entity\User $user */
        $user = $service->register($post);

        // set role moderator
        $em = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        $modRole = $em->getRepository('User\Entity\Role')->findOneBy(['roleId' => 'moderator']);
        $user->addRole($modRole);
        $em->merge($user);
        $em->flush();

        $this->flashMessenger()->addSuccessMessage('Created new moderator successfully!');
        return $this->redirect()->toRoute('zfcadmin');
    }
}
