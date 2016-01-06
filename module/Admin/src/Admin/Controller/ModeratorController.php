<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/2/15
 * Time: 7:07 PM.
 */
namespace Admin\Controller;

use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use User\Form\EditForm;
use Zend\Crypt\Password\Bcrypt;
use Zend\Form\Form;
use Zend\Paginator\Paginator;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\View\Model\ViewModel;
use ZfcUser\Controller\UserController;

class ModeratorController extends UserController
{
    protected $_entityManager = null;

    public function __construct()
    {
    }

    public function getEntityManager()
    {
        if (null === $this->_entityManager) {
            $this->_entityManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        }

        return $this->_entityManager;
    }

    public function indexAction()
    {
        $em = $this->getEntityManager();
        $users = $em->getRepository('User\Entity\User');

        $qb = $users->createQueryBuilder('user');
        $qb = $qb
            ->innerJoin('user.roles', 'r')
            ->where("r.roleId='moderator'");

        // set order by blog id DESC
        $qb->orderBy('user.id', 'DESC');
        // end filter
        $adapter = new DoctrineAdapter(new ORMPaginator($qb));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int) $this->getRequest()->getQuery('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return new ViewModel([
            'paginator' => $paginator,
        ]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        /** @var \User\Entity\User $moderator */
        $moderator = $this->getEntityManager()->find('User\Entity\User', $id);
        $form = new EditForm();
        $form->setData([
            'id'          => $moderator->getId(),
            'displayName' => $moderator->getDisplayName(),
        ]);

        if ($this->getRequest()->isPost()) {
            $em = $this->getEntityManager();
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $change = 0;
                if ($data['displayName'] != $moderator->getDisplayName()) {
                    $moderator->setDisplayName($data['displayName']);
                    ++$change;
                }
                if ($data['password'] && $data['confirmation']) {
                    /** @var \ZfcUser\Service\User $service */
                    $service = $this->getUserService();
                    $bcrypt = new Bcrypt();
                    $bcrypt->setCost($service->getOptions()->getPasswordCost());
                    $pass = $bcrypt->create($data['password']);
                    $moderator->setPassword($pass);
                    ++$change;
                }
                if ($change) {
                    $em->merge($moderator);
                    $em->flush();
                }
                $this->flashMessenger()->addSuccessMessage(sprintf('Moderator "%s" has been edited successfully.',
                    $moderator->getEmail()));

                return $this->redirect()->toRoute('zfcadmin/moderator');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
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
            .($redirect ? '?redirect='.rawurlencode($redirect) : '');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return [
                'registerForm'       => $form,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
                'redirect'           => $redirect,
            ];
        }

        $post = $prg;
        /** @var \User\Entity\User $user */
        $user = $service->register($post);

        // set role moderator
        $em = $this->getEntityManager();
        $modRole = $em->getRepository('User\Entity\Role')->findOneBy(['roleId' => 'moderator']);
        $user->addRole($modRole);
        $em->merge($user);
        $em->flush();

        $this->flashMessenger()->addSuccessMessage('Created new moderator successfully!');

        return $this->redirect()->toRoute('zfcadmin');
    }
}
