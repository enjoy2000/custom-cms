<?php

namespace Landing\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Menu
{
    private $_serviceLocator = null;

    public function renderMenu($routeMatch, $serviceLocator, $name = null)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $this->_serviceLocator = $serviceLocator;
        if ($routeMatch) {
            $routeName = $routeMatch->getMatchedRouteName();
            $currentSlug = $routeMatch->getParam('slug', null);
        } else {
            $routeName = '404';
            $currentSlug = null;
        }

        $rootMenus = $em->getRepository('Landing\Entity\Menu')->findBy(['parentMenu' => null]);
        $rootMenus = \Landing\Entity\Menu::sortByOrderNumber($rootMenus);

        //$html = '<ul class="nav navbar-nav">';
        $html = '';

        /** @var \Landing\Entity\Menu $menu */
        foreach ($rootMenus as $menu) {
            if ($this->_isActive($em, $menu, $routeMatch)) {
                $active = ' active current-menu-item';
            } else {
                $active = '';
            }
            $data = $menu->getMenu($this->_getLocaleShortCode());
            if (!$menu->hasChild($em)) {
                $html .= '<li class="'
                    . $active
                    . '"><a href="'
                    . $this->_getUrl($menu, $name)
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . '</a></li>';
            } else {
                $html .= '<li class="dropdown'
                    . $active
                    . '"><a data-toggle="dropdown" href="'
                    . $this->_getUrl($menu, $name)
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . ' <span class="caret"></span>'
                    . '</a>'
                    . $this->_renderChild($menu, $em, $name)
                    . '</li>';
            }
        }
        //$html .= '</ul>';

        return $html;
    }

    public function renderSidebar($routeMatch, $serviceLocator)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $this->_serviceLocator = $serviceLocator;
        if ($routeMatch) {
            $routeName = $routeMatch->getMatchedRouteName();
            $currentSlug = $routeMatch->getParam('slug', null);
        } else {
            $routeName = '404';
            $currentSlug = null;
        }
        if ($routeName == 'blog/view') {
            $urlKey = $currentSlug;
        } else {
            $urlKey = $routeName;
        }
        //var_dump($urlKey);die;
        $currentMenu = $em->getRepository('Landing\Entity\Menu')->createQueryBuilder('m')
            ->where('m.value = :key')
            ->setParameter(':key', $urlKey)
            ->orwhere('m.valueAr = :keyar')
            ->setParameter(':keyar', $urlKey)
            ->getQuery()
            ->getResult();
        //var_dump($currentMenu);die;
        if (!empty($currentMenu)) {
            $parentMenu = $currentMenu[0]->getParentMenu() ? $currentMenu[0]->getParentMenu() : $currentMenu[0];
        }

        $parentData = $parentMenu->getMenu($this->_getLocaleShortCode());

        $html = '<div class="list-group panel default-panel">';

        $html
            .= '<div class="panel-heading">'
            . '<a href="'
            . $parentData['link']
            . '" title="'
            . $parentData['label']
            . '">'
            . $parentData['label']
            . '</a>'
            . '</div>'
        ;

        if ($parentMenu->hasChild($em)) {
            foreach ($parentMenu->getChildMenus($em) as $menu) {
                $data = $menu->getMenu($this->_getLocaleShortCode());
                if ($this->_isActive($em, $menu, $routeMatch)) {
                    $active = ' active';
                } else {
                    $active = '';
                }
                $html
                    .= '<a class="list-group-item'
                    . $active
                    . '" href="'
                    . $data['link']
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . '</a>'
                ;
            }
        }

        $html .= '</div>';

        return $html;
    }

    protected function _renderChild($parent, $em, $name = null)
    {
        $html = '';
        if ($parent->hasChild($em)) {
            $html .= '<ul class="dropdown-menu" role="menu">';
            foreach ($parent->getChildMenus($em) as $menu) {
                if ($name != null && $menu->getShowMenu()) {
                    $data = $menu->getMenu($this->_getLocaleShortCode());
                    $html .= '<li><a href="'
                        . $this->_getUrl($menu, $name)
                        . '" title="'
                        . $data['label']
                        . '">'
                        . $data['label']
                        . '</a></li>';
                }
            }
            $html .= '</ul>';
        }

        return $html;
    }

    protected function _getLocaleShortCode()
    {
        return \Locale::getPrimaryLanguage(\Locale::getDefault());
    }

    protected function _sortByOrderNumber($menus)
    {
        $sortedMenus = [];
        foreach ($menus as $menu)
        {
            $sortedMenus[$menu->getId()] = $menu;
        }
        ksort($sortedMenus);

        return $sortedMenus;
    }

    protected function _url($name = null, $params = array(), $options = array(), $reuseMatchedParams = false)
    {
        //var_dump($arr);die;
        if (empty($params)) {
            return $this->_serviceLocator->get('ViewHelperManager')->get('url')->__invoke($name);
        } else {
            return $this->_serviceLocator->get('ViewHelperManager')->get('url')->__invoke($name, $params);
        }
    }

    protected function _getUrl($menu, $name = null)
    {

        if ($name = 'admin') {
            return $this->_url('zfcadmin/menu', ['action' => 'edit', 'id' => $menu->getId()]);
        }
        $data = $menu->getMenu($this->_getLocaleShortCode());
        $type = $menu->getType();
        switch ($type) {
            case 'category':
            case 'article':
                $url =  $this->_url('blog/view', ['slug' => $data['link']]);
                break;
            case 'static':
                $url = $this->_url($data['link']);
                break;
            case 'external':
                $url = $data['link'];
                break;
        }

        return $url;
    }

    protected function _isActive($em, $menu, $routeMatch)
    {
        if ($routeMatch) {
            $routeName = $routeMatch->getMatchedRouteName();
            $currentSlug = $routeMatch->getParam('slug', null);
        } else {
            $routeName = '404';
            $currentSlug = null;
        }

        $arrKeys = [];
        $menuData = $menu->getMenu($this->_getLocaleShortCode());
        $arrKeys[] = $menuData['link'];
        foreach ($menu->getChildMenus($em) as $childMenu) {
            $childData = $childMenu->getMenu($this->_getLocaleShortCode());
            $arrKeys[] = $childData['link'];
        }

        return (in_array($routeName, $arrKeys) || in_array($currentSlug, $arrKeys));
    }
}
