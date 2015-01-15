<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link       for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'landing' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/landing/[:controller[/[:action[/]]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Landing\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                ),
            ),
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'the-ministry' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/the-ministry',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\Ministry',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'faq' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/faq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'faq',
                            ),
                        ),
                    ),
                    'ministry-departments' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/ministry-departments',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'ministryDepartments',
                            ),
                        ),
                    ),
                    'the-minister' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/the-minister',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'theMinister',
                            ),
                        ),
                    ),
                    'speeches-interviews' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/speeches-interviews',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'speechesInterviews',
                            ),
                        ),
                    ),
                    'undersecretaries' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/undersecretaries',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'undersecretaries',
                            ),
                        ),
                    ),
                    'announcements' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/announcements',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'announcements',
                            ),
                        ),
                    ),
                    'magazine' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/magazine',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'magazine',
                            ),
                        ),
                    ),
                ),
            ),
            'about-iraq' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/about-iraq',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\AboutIraq',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'investment' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/investment',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'investment',
                            ),
                        ),
                    ),
                    'constitution' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/constitution',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'constitution',
                            ),
                        ),
                    ),
                    'encyclopedia' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/encyclopedia',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'encyclopedia',
                            ),
                        ),
                    ),
                    'announcements' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/announcements',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'announcements',
                            ),
                        ),
                    ),
                ),
            ),
            'foreign-policy' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/foreign-policy',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\ForeignPolicy',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'press-releases' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/the-new-iraq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'theNewIraq',
                            ),
                        ),
                    ),
                    'international-organizations' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/international-organizations',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'internationalOrganizations',
                            ),
                        ),
                    ),
                ),
            ),
            'diplomatic-missions' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/diplomatic-missions',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\DiplomaticMissions',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'iraqi-ambassadors' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/iraqi-ambassadors',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraqiAmbassadors',
                            ),
                        ),
                    ),
                ),
            ),
            'consular-services' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/consular-services',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\ConsularServices',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'other-links' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/other-links',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'otherLinks',
                            ),
                        ),
                    ),
                ),
            ),
            'contact-us' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/contact-us',
                    'defaults' => array(
                        'controller' => 'Landing\Controller\ContactUs',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Landing\Controller\AboutIraq' => 'Landing\Controller\AboutIraqController',
            'Landing\Controller\ConsularServices' => 'Landing\Controller\ConsularServicesController',
            'Landing\Controller\ContactUs' => 'Landing\Controller\ContactUsController',
            'Landing\Controller\ForeignPolicy' => 'Landing\Controller\ForeignPolicyController',
            'Landing\Controller\DiplomaticMissions' => 'Landing\Controller\DiplomaticMissionsController',
            'Landing\Controller\Index' => 'Landing\Controller\IndexController',
            'Landing\Controller\Ministry' => 'Landing\Controller\MinistryController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'sidebar' => __DIR__ . '/../view/partial/sidebar.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

    // Doctrine
    'doctrine' => array(
        'driver' => array(
            'landing_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Landing/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Landing\Entity' => 'landing_entities'
                )
            ))),
);