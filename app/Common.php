<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

/**
 * a default password for all new user
 */
define('DEFAULT_PASSWORD', 'jasmine');

if (!function_exists('env_is')) {
    /** check codeigniter environtment
     * @param string $env development or production
     */
    function env_is(string $env): bool
    {
        $environtment = getenv('CI_ENVIRONMENT') ?: 'production';
        return ($env == $environtment);
    }
}

if (!function_exists('space_replace')) {
    /**
     * replace all space and new line
     */
    function space_replace(?string $string, string $replace = ' '): string
    {
        $result = preg_replace('/\s+/', $replace, '' . $string);
        return trim($result);
    }
}

/**
 * @var string|null 404 override
 */
define('OVERRIDE_404', env_is('production') ? 'App\Controllers\Errors::index' : null);
