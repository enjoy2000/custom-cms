    <?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'news-ticker' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/news-ticker',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'news-ticker',
                    ),
                ),
            ),
            'latest-news' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/latest-news',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'latest-news',
                    ),
                ),
            ),
            'blog' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/news',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'custom_links' => [
                    [
                        'label' => 'Minister Speeches',
                        'link' => [
                            'en' => 'minister-speeches',
                            'ar' => 'arabic-minister-speeches'
                        ],
                    ],
                    [
                        'label' => 'Press Conferences',
                        'link' => [
                            'en' => 'press-conferences',
                            'ar' => 'ar-press-conferences'
                        ],
                    ],
                    [
                        'label' => 'Video Library',
                        'link' => [
                            'en' => 'video-library',
                            'ar' => 'ar-video-library'
                        ],
                    ],
                    [
                        'label' => 'Photo Library',
                        'link' => [
                            'en' => 'photo-library',
                            'ar' => 'ar-photo-library'
                        ],
                    ],
                    [
                        'label' => 'Other Headlines',
                        'link' => [
                            'en' => 'other-headlines',
                            'ar' => 'ar-other-headlines'
                        ],
                    ],
                    [
                        'label' => 'Contact Press Department',
                        'link' => [
                            'en' => 'en-contact-press-department',
                            'ar' => 'ar-mofa-contact-press-department'
                        ],
                    ],
                    [
                        'label' => 'Official Documents',
                        'link' => [
                            'en' => 'en-official-documents',
                            'ar' => 'ar-mofa-official-documents'
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
                    'view' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:slug]',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Blog',
                                'action' => 'view',
                            ),
                        ),
                    ),
                ),
            ),
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
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Index' => 'Blog\Controller\IndexController',
            'Blog\Controller\Category' => 'Blog\Controller\CategoryController',
            'Blog\Controller\Blog' => 'Blog\Controller\BlogController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'blog/index/index' => __DIR__ . '/../view/blog/index/index.phtml',
            //'blog/index/news-ticker' => __DIR__ . '/../view/blog/index/news-ticker.phtml',
            'article_partial' => __DIR__ . '/../view/partial/article.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            'Blog' . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . 'Blog' . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Blog' . '\Entity' => 'Blog' . '_driver'
                )
            )
        )
    ),
);
