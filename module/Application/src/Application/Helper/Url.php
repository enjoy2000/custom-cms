<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 12/31/14
 * Time: 2:00 AM
 */

namespace Application\Helper;


class Url {

    public function __construct()
    {
        setlocale(LC_ALL, 'en_US.UTF8');
    }

    public static function formatUrl($str, $replace=array(), $delimiter='-') {
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
} 