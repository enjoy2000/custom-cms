<?php

namespace Landing\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Menu
{
    private $_serviceLocator = null;

    public function renderMenu($routeMatch, $serviceLocator)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $this->_serviceLocator = $serviceLocator;
        if ($routeMatch) {
            $routeName = $routeMatch->getMatchedRouteName();
            $currentSlug = $routeMatch->getParams('slug', null);
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
                    . $this->_getUrl($menu)
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . '</a></li>';
            } else {
                $html .= '<li class="dropdown'
                    . $active
                    . '"><a data-toggle="dropdown" href="'
                    . $this->_getUrl($menu)
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . ' <span class="caret"></span>'
                    . '</a>'
                    . $this->_renderChild($menu, $em)
                    . '</li>';
            }
        }
        //$html .= '</ul>';

        return $html;
    }

    protected function _renderChild($parent, $em)
    {
        $html = '';
        if ($parent->hasChild($em)) {
            $html .= '<ul class="dropdown-menu" role="menu">';
            foreach ($parent->getChildMenus($em) as $menu) {
                $data = $menu->getMenu($this->_getLocaleShortCode());
                $html .= '<li><a href="'
                    . $this->_getUrl($menu)
                    . '" title="'
                    . $data['label']
                    . '">'
                    . $data['label']
                    . '</a></li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }

    protected function _getLocaleShortCode()
    {
        return \Locale::getPrimaryLanguage(\Locale::getDefault());
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

    protected function _getUrl($menu)
    {
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
            $currentSlug = $routeMatch->getParams('slug', null);
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
