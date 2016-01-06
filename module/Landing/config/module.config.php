<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link       for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'landing' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/landing/[:controller[/[:action[/]]]]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Landing\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                ],
            ],
            'home' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Landing\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'the-ministry' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/the-ministry',
                    'defaults' => [
                        'controller' => 'Landing\Controller\Ministry',
                        'action'     => 'index',
                    ],
                ],
                'custom_links' => [
                    [
                        'label' => 'Press Releases',
                        'link'  => [
                            'en' => 'press-releases',
                            'ar' => 'arabic-press-releases',
                        ],
                    ],
                    [
                        'label' => 'Speeches & Interviews',
                        'link'  => [
                            'en' => 'speeches-interviews',
                            'ar' => 'arabic-speeches-interviews',
                        ],
                    ],
                    [
                        'label' => 'Ministry\'s Announcements',
                        'link'  => [
                            'en' => 'ministry-s-announcements',
                            'ar' => 'arabic-ministry-s-announcements',
                        ],
                    ],
                    [
                        'label' => 'Announcements',
                        'link'  => [
                            'en' => 'announcements',
                            'ar' => 'arabic-announcements',
                        ],
                    ],
                    [
                        'label' => 'Ministry\'s Magazine',
                        'link'  => [
                            'en' => 'ministry-s-magazine',
                            'ar' => 'arabic-ministry-s-magazine',
                        ],
                    ],
                    [
                        'label' => 'Undersecretaries',
                        'link'  => [
                            'en' => 'undersecretaries',
                            'ar' => 'ar-undersecretaries',
                        ],
                    ],
                    [
                        'label' => 'Iraqi Ambassadors',
                        'link'  => [
                            'en' => 'en-iraqi-mofa-ambassadors',
                            'ar' => 'ar-iraqi-mofa-ambassadors',
                        ],
                    ],
                    [
                        'label' => 'Ministry Departments',
                        'link'  => [
                            'en' => 'en-ministry-departments',
                            'ar' => 'ar-mofa-ministry-departments',
                        ],
                    ],
                    [
                        'label' => 'Other Links',
                        'link'  => [
                            'en' => 'en-other-links',
                            'ar' => 'ar-other-links',
                        ],
                    ],
                    [
                        'label' => 'Martyrs of The Ministry of Foreign Affairs',
                        'link'  => [
                            'en' => 'en-martyrs-of-the-inistry-of-foreign-affairs',
                            'ar' => 'ar-martyrs-of-the-inistry-of-foreign-affairs',
                        ],
                    ],
                    [
                        'label' => 'The Ministry Law No. 36 of 2013',
                        'link'  => [
                            'en' => 'the-ministry-law-no-36-of-2013',
                            'ar' => 'ar-the-ministry-law-no-36-of-2013',
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'faq' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/faq',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'faq',
                            ],
                        ],
                    ],
                    'ministry-departments' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/ministry-departments',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'ministryDepartments',
                            ],
                        ],
                        'hide' => true,
                    ],
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
                    'announcements' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/announcements',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'announcements',
                            ],
                        ],
                        'hide' => true,
                    ],
                    'magazine' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/magazine',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'magazine',
                            ],
                        ],
                        'hide' => true,
                    ],
                    'the-minister' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/the-minister',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'theMinister',
                            ],
                        ],
                    ],
                    'mofa-ministers' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/mofa-ministers',
                            'defaults' => [
                                'controller' => 'Landing\Controller\Ministry',
                                'action'     => 'mofa-ministers',
                            ],
                        ],
                    ],
                ],
            ],
            'about-iraq' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/about-iraq',
                    'defaults' => [
                        'controller' => 'Landing\Controller\AboutIraq',
                        'action'     => 'index',
                    ],
                ],
                'custom_links' => [
                    [
                        'label' => 'Religious Tourism',
                        'link'  => [
                            'en' => 'en-religious-tourism',
                            'ar' => 'ar-mofa-religious-tourism',
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'announcements' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/announcements',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'announcements',
                            ],
                        ],
                    ],
                    'constitution' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/constitution',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'constitution',
                            ],
                        ],
                    ],
                    'encyclopedia' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/encyclopedia',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'encyclopedia',
                            ],
                        ],
                    ],
                    'investment' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/investment',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'investment',
                            ],
                        ],
                    ],
                    'the-virtual-museum-of-iraq' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/the-virtual-museum-of-iraq',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'the-virtual-museum-of-iraq',
                            ],
                        ],
                    ],
                    'tourist-guide' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/tourist-guide',
                            'defaults' => [
                                'controller' => 'Landing\Controller\AboutIraq',
                                'action'     => 'tourist-guide',
                            ],
                        ],
                    ],
                ],
            ],
            'foreign-policy' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/foreign-policy',
                    'defaults' => [
                        'controller' => 'Landing\Controller\ForeignPolicy',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'arab-league' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/arab-league',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'arab-league',
                            ],
                        ],
                    ],
                    'economic-rehabilitation' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/economic-rehabilitation',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'economic-rehabilitation',
                            ],
                        ],
                    ],
                    'human-rights' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/human-rights',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'human-rights',
                            ],
                        ],
                    ],
                    'international-organizations' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/international-organizations',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'internationalOrganizations',
                            ],
                        ],
                    ],
                    'iraq-and-the-united-nations' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/iraq-and-the-united-nations',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-and-the-united-nations',
                            ],
                        ],
                    ],
                    'iraq-s-diplomatic-missions' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/iraq-s-diplomatic-missions',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-s-diplomatic-missions',
                            ],
                        ],
                    ],
                    'iraq-s-security' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/iraq-s-security',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraq-s-security',
                            ],
                        ],
                    ],
                    'iraqi-treaties' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/iraqi-treaties',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraqi-treaties',
                            ],
                        ],
                    ],
                    'reforming-the-ministry' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/reforming-the-ministry',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'reforming-the-ministry',
                            ],
                        ],
                    ],
                    'security-council-resolutions' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/security-council-resolutions',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'security-council-resolutions',
                            ],
                        ],
                    ],
                    'the-new-iraq' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/the-new-iraq',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'theNewIraq',
                            ],
                        ],
                    ],
                ],
            ],
            'diplomatic-missions' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/diplomatic-missions',
                    'defaults' => [
                        'controller' => 'Landing\Controller\DiplomaticMissions',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'iraqi-ambassadors' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/iraqi-ambassadors',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ForeignPolicy',
                                'action'     => 'iraqiAmbassadors',
                            ],
                        ],
                    ],
                ],
            ],
            'consular-services' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/consular-services',
                    'defaults' => [
                        'controller' => 'Landing\Controller\ConsularServices',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'approving-corpse-entry-to-iraq' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/approving-corpse-entry-to-iraq',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'approving-corpse-entry-to-iraq',
                            ],
                        ],
                    ],
                    'authorization' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/authorization',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'authorization',
                            ],
                        ],
                    ],
                    'birth-certificate' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/birth-certificate',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'birth-certificate',
                            ],
                        ],
                    ],
                    'certificate-of-origin' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/certificate-of-origin',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'certificate-of-origin',
                            ],
                        ],
                    ],
                    'death-certificate' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/death-certificate',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'death-certificate',
                            ],
                        ],
                    ],
                    'extension-of-passports' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/extension-of-passports',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'extension-of-passports',
                            ],
                        ],
                    ],
                    'faq' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/faq',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'faq',
                            ],
                        ],
                    ],
                    'fees' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/fees',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'fees',
                            ],
                        ],
                    ],
                    'forms' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/forms',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'forms',
                            ],
                        ],
                    ],
                    'general-affairs' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/general-affairs',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'general-affairs',
                            ],
                        ],
                    ],
                    'indigent-deportation' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/indigent-deportation',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'indigent-deportation',
                            ],
                        ],
                    ],
                    'lawsuits' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/lawsuits',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'lawsuits',
                            ],
                        ],
                    ],
                    'life-certificate' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/life-certificate',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'life-certificate',
                            ],
                        ],
                    ],
                    'loss-of-passports' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/loss-of-passports',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'loss-of-passports',
                            ],
                        ],
                    ],
                    'marriage-divorces-registration' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/marriage-divorces-registration',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'marriage-divorces-registration',
                            ],
                        ],
                    ],
                    'nationality-cert' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/nationality-cert',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'nationality-cert',
                            ],
                        ],
                    ],
                    'non-conviction-certificate' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/non-conviction-certificate',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'non-conviction-certificate',
                            ],
                        ],
                    ],
                    'palestinian-travel-documents' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/palestinian-travel-documents',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'palestinian-travel-documents',
                            ],
                        ],
                    ],
                    'pass-doc' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/pass-doc',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'pass-doc',
                            ],
                        ],
                    ],
                    'passport-system' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/passport-system',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'passport-system',
                            ],
                        ],
                    ],
                    'passports-issuance' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/passports-issuance',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'passports-issuance',
                            ],
                        ],
                    ],
                    'patrimonies' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/patrimonies',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'patrimonies',
                            ],
                        ],
                    ],
                    'ratifications' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/ratifications',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'ratifications',
                            ],
                        ],
                    ],
                    'the-civil-status-id' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/the-civil-status-id',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'the-civil-status-id',
                            ],
                        ],
                    ],
                    'visa' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/visa',
                            'defaults' => [
                                'controller' => 'Landing\Controller\ConsularServices',
                                'action'     => 'visa',
                            ],
                        ],
                    ],
                ],
            ],
            'contact-us' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/contact-us',
                    'defaults' => [
                        'controller' => 'Landing\Controller\ContactUs',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Landing\Controller\AboutIraq'          => 'Landing\Controller\AboutIraqController',
            'Landing\Controller\ConsularServices'   => 'Landing\Controller\ConsularServicesController',
            'Landing\Controller\ContactUs'          => 'Landing\Controller\ContactUsController',
            'Landing\Controller\ForeignPolicy'      => 'Landing\Controller\ForeignPolicyController',
            'Landing\Controller\DiplomaticMissions' => 'Landing\Controller\DiplomaticMissionsController',
            'Landing\Controller\Index'              => 'Landing\Controller\IndexController',
            'Landing\Controller\Ministry'           => 'Landing\Controller\MinistryController',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map'             => [
            'sidebar' => __DIR__.'/../view/partial/sidebar.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view',
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' => [
        'locale'                    => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__.'/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],

    // Doctrine
    'doctrine' => [
        'driver' => [
            'landing_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__.'/../src/Landing/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'Landing\Entity' => 'landing_entities',
                ],
            ],
        ],
    ],
];
