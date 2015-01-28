<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 22/01/2015
 * Time: 17:57
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;

/**
 * Returns total value (with tax)
 *
 */
class Em extends AbstractHelper
{
    /**
     * Service Locator
     * @var ServiceManager
     */
    protected $serviceLocator;

    /**
     * __invoke
     *
     * @access public
     * @param  string
     * @return String
     */
    public function __invoke()
    {
        $em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');

        return $em;
    }

    /**
     * Setter for $serviceLocator
     * @param ServiceManager $serviceLocator
     */
    public function setServiceLocator(ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}