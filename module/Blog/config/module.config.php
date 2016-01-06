    <?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'news-ticker' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/news-ticker',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'news-ticker',
                    ],
                ],
            ],
            'latest-news' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/latest-news',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'latest-news',
                    ],
                ],
            ],
            'blog' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/news',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
                'custom_links' => [
                    [
                        'label' => 'Minister Speeches',
                        'link'  => [
                            'en' => 'minister-speeches',
                            'ar' => 'arabic-minister-speeches',
                        ],
                    ],
                    [
                        'label' => 'Press Conferences',
                        'link'  => [
                            'en' => 'press-conferences',
                            'ar' => 'ar-press-conferences',
                        ],
                    ],
                    [
                        'label' => 'Video Library',
                        'link'  => [
                            'en' => 'video-library',
                            'ar' => 'ar-video-library',
                        ],
                    ],
                    [
                        'label' => 'Photo Library',
                        'link'  => [
                            'en' => 'photo-library',
                            'ar' => 'ar-photo-library',
                        ],
                    ],
                    [
                        'label' => 'Other Headlines',
                        'link'  => [
                            'en' => 'other-headlines',
                            'ar' => 'ar-other-headlines',
                        ],
                    ],
                    [
                        'label' => 'Contact Press Department',
                        'link'  => [
                            'en' => 'en-contact-press-department',
                            'ar' => 'ar-mofa-contact-press-department',
                        ],
                    ],
                    [
                        'label' => 'Official Documents',
                        'link'  => [
                            'en' => 'en-official-documents',
                            'ar' => 'ar-mofa-official-documents',
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'view' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'    => '/[:slug]',
                            'defaults' => [
                                'controller' => 'Blog\Controller\Blog',
                                'action'     => 'view',
                            ],
                        ],
                    ],
                ],
            ],
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
    'controllers' => [
        'invokables' => [
            'Blog\Controller\Index'    => 'Blog\Controller\IndexController',
            'Blog\Controller\Category' => 'Blog\Controller\CategoryController',
            'Blog\Controller\Blog'     => 'Blog\Controller\BlogController',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map'             => [
            'blog/index/index' => __DIR__.'/../view/blog/index/index.phtml',
            //'blog/index/news-ticker' => __DIR__ . '/../view/blog/index/news-ticker.phtml',
            'article_partial' => __DIR__.'/../view/partial/article.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view',
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
    // Doctrine config
    'doctrine' => [
        'driver' => [
            'Blog'.'_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__.'/../src/'.'Blog'.'/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog'.'\Entity' => 'Blog'.'_driver',
                ],
            ],
        ],
    ],
];
