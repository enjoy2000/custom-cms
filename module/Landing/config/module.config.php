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
                'custom_links' => [
                    [
                        'label' => 'Press Releases',
                        'link' => [
                            'en' => 'press-releases',
                            'ar' => 'arabic-press-releases'
                        ],
                    ],
                    [
                        'label' => 'Speeches & Interviews',
                        'link' => [
                            'en' => 'speeches-interviews',
                            'ar' => 'arabic-speeches-interviews'
                        ],
                    ],
                    [
                        'label' => 'Ministry\'s Announcements',
                        'link' => [
                            'en' => 'ministry-s-announcements',
                            'ar' => 'arabic-ministry-s-announcements'
                        ],
                    ],
                    [
                        'label' => 'Announcements',
                        'link' => [
                            'en' => 'announcements',
                            'ar' => 'arabic-announcements'
                        ],
                    ],
                    [
                        'label' => 'Ministry\'s Magazine',
                        'link' => [
                            'en' => 'ministry-s-magazine',
                            'ar' => 'arabic-ministry-s-magazine'
                        ],
                    ],
                    [
                        'label' => 'Undersecretaries',
                        'link' => [
                            'en' => 'undersecretaries',
                            'ar' => 'ar-undersecretaries'
                        ],
                    ],
                    [
                        'label' => 'Iraqi Ambassadors',
                        'link' => [
                            'en' => 'en-iraqi-mofa-ambassadors',
                            'ar' => 'ar-iraqi-mofa-ambassadors'
                        ],
                    ],
                    [
                        'label' => 'Ministry Departments',
                        'link' => [
                            'en' => 'en-ministry-departments',
                            'ar' => 'ar-mofa-ministry-departments'
                        ],
                    ],
                    [
                        'label' => 'Other Links',
                        'link' => [
                            'en' => 'en-other-links',
                            'ar' => 'ar-mofa-other-links'
                        ],
                    ],
                    [
                        'label' => 'Martyrs of The Ministry of Foreign Affairs',
                        'link' => [
                            'en' => 'en-martyrs-of-the-inistry-of-foreign-affairs',
                            'ar' => 'ar-martyrs-of-the-inistry-of-foreign-affairs'
                        ],
                    ],
                    [
                        'label' => 'The Ministry Law No. 36 of 2013',
                        'link' => [
                            'en' => 'the-ministry-law-no-36-of-2013',
                            'ar' => 'ar-the-ministry-law-no-36-of-2013'
                        ],
                    ],
                ],
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
                        'hide' => true,
                    ),
                    /*
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
                    ),*/
                    'announcements' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/announcements',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'announcements',
                            ),
                        ),
                        'hide' => true,
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
                        'hide' => true,
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
                    'mofa-ministers' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/mofa-ministers',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'mofa-ministers',
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
                'custom_links' => [
                    [
                        'label' => 'Religious Tourism',
                        'link' => [
                            'en' => 'en-religious-tourism',
                            'ar' => 'ar-mofa-religious-tourism'
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
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
                    'the-virtual-museum-of-iraq' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/the-virtual-museum-of-iraq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'the-virtual-museum-of-iraq',
                            ),
                        ),
                    ),
                    'tourist-guide' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/tourist-guide',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'tourist-guide',
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
                    'arab-league' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/arab-league',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'arab-league',
                            ),
                        ),
                    ),
                    'economic-rehabilitation' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/economic-rehabilitation',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'economic-rehabilitation',
                            ),
                        ),
                    ),
                    'human-rights' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/human-rights',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'human-rights',
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
                    'iraq-and-the-united-nations' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/iraq-and-the-united-nations',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-and-the-united-nations',
                            ),
                        ),
                    ),
                    'iraq-s-diplomatic-missions' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/iraq-s-diplomatic-missions',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-s-diplomatic-missions',
                            ),
                        ),
                    ),
                    'iraq-s-security' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/iraq-s-security',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-s-security',
                            ),
                        ),
                    ),
                    'iraqi-treaties' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/iraqi-treaties',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraqi-treaties',
                            ),
                        ),
                    ),
                    'reforming-the-ministry' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/reforming-the-ministry',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'reforming-the-ministry',
                            ),
                        ),
                    ),
                    'security-council-resolutions' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/security-council-resolutions',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'security-council-resolutions',
                            ),
                        ),
                    ),
                    'the-new-iraq' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/the-new-iraq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'theNewIraq',
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
                    'approving-corpse-entry-to-iraq' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/approving-corpse-entry-to-iraq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'approving-corpse-entry-to-iraq',
                            ),
                        ),
                    ),
                    'authorization' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/authorization',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'authorization',
                            ),
                        ),
                    ),
                    'birth-certificate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/birth-certificate',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'birth-certificate',
                            ),
                        ),
                    ),
                    'certificate-of-origin' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/certificate-of-origin',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'certificate-of-origin',
                            ),
                        ),
                    ),
                    'death-certificate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/death-certificate',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'death-certificate',
                            ),
                        ),
                    ),
                    'extension-of-passports' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/extension-of-passports',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'extension-of-passports',
                            ),
                        ),
                    ),
                    'faq' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/faq',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'faq',
                            ),
                        ),
                    ),
                    'fees' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/fees',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'fees',
                            ),
                        ),
                    ),
                    'forms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/forms',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'forms',
                            ),
                        ),
                    ),
                    'general-affairs' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/general-affairs',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'general-affairs',
                            ),
                        ),
                    ),
                    'indigent-deportation' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/indigent-deportation',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'indigent-deportation',
                            ),
                        ),
                    ),
                    'lawsuits' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/lawsuits',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'lawsuits',
                            ),
                        ),
                    ),
                    'life-certificate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/life-certificate',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'life-certificate',
                            ),
                        ),
                    ),
                    'loss-of-passports' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/loss-of-passports',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'loss-of-passports',
                            ),
                        ),
                    ),
                    'marriage-divorces-registration' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/marriage-divorces-registration',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'marriage-divorces-registration',
                            ),
                        ),
                    ),
                    'nationality-cert' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/nationality-cert',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'nationality-cert',
                            ),
                        ),
                    ),
                    'non-conviction-certificate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/non-conviction-certificate',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'non-conviction-certificate',
                            ),
                        ),
                    ),
                    'palestinian-travel-documents' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/palestinian-travel-documents',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'palestinian-travel-documents',
                            ),
                        ),
                    ),
                    'pass-doc' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/pass-doc',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'pass-doc',
                            ),
                        ),
                    ),
                    'passport-system' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/passport-system',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'passport-system',
                            ),
                        ),
                    ),
                    'passports-issuance' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/passports-issuance',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'passports-issuance',
                            ),
                        ),
                    ),
                    'patrimonies' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/patrimonies',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'patrimonies',
                            ),
                        ),
                    ),
                    'ratifications' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/ratifications',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'ratifications',
                            ),
                        ),
                    ),
                    'the-civil-status-id' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/the-civil-status-id',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'the-civil-status-id',
                            ),
                        ),
                    ),
                    'visa' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route'    => '/visa',
                            'defaults' => array(
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'visa',
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