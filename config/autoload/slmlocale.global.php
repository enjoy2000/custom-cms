<?php
/**
 * SlmLocale Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(
    /**
     * Default locale
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'default' => '',

    /**
     * Supported locales
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'supported' => array('', 'ar'),

    /**
     * Aliases for locales
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'aliases' => array('ar' => 'ar-IQ', '' => 'en-US'),

    /**
     * Strategies
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'strategies' => array('uripath', 'acceptlanguage'),

    /**
     * Throw exception when no locale is found
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    //'throw_exception' => false,

    /**
     * End of SlmLocale configuration
     */
);

/**
 * You do not need to edit below this line
 */
return array(
    'slm_locale' => $settings
);
