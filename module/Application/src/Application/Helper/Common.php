<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 12/31/14
 * Time: 2:00 AM
 */

namespace Application\Helper;


class Common {

    public function __construct()
    {
        setlocale(LC_ALL, 'en_US.UTF8');
    }

    /**
     * Return name with Uppercase the first character of each word in a string
     *
     * @param string $route
     * @return string
     */
    public static function getNameFromRoute($route)
    {
        $route = str_replace('-', ' ', $route);
        $route = str_replace('/', '', $route);
        $route = str_replace(' s ', '\'s ', $route);
        $route = ucwords($route);
        $route = str_replace(' Of ', ' of ', $route);

        return $route;
    }
} 