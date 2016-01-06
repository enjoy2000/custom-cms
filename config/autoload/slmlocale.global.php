<?php
/**
 * SlmLocale Configuration.
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = [
    /*
     * Default locale
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    //'default' => 'ar-IQ',

    /*
     * Supported locales
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'supported' => ['en', 'ar', ''],

    /*
     * Aliases for locales
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'aliases' => ['' => 'ar-IQ', 'ar' => 'ar-IQ', 'en' => 'en-US'],

    /*
     * Strategies
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    'strategies' => ['uripath', 'acceptlanguage'],

    /*
     * Throw exception when no locale is found
     *
     * Some good description here. Default is something
     *
     * Accepted is something else
     */
    //'throw_exception' => false,

    /*
     * End of SlmLocale configuration
     */
];

/*
 * You do not need to edit below this line
 */
return [
    'slm_locale' => $settings,
];
