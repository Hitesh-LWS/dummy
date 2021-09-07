<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (!function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param string|array $route
     * @param string $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}


/**
 * This function return asset link based on link.php settings
 * @param string $type
 * @param string $key
 * @return type
 */
function assetLink(string $type, string $key)
{
    // if request if language, it should append & language to it
    return asset(config('installer' . $type . '.' . $key));
}


/**
 * Check if white label plugin is enabled
 * @return boolean
 */
function isWhiteLabelEnabled()
{
    return is_dir(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'Whitelabel');
}


/**
 * make sure this feature is enabled or not in env
 * customize user registration code according to application
 * @param $request
 * @return Exception
 * @author Hitesh Kumar <Hitesh.kumar@ladybirdweb.com>
 */
function createUserForInstaller($request)
{
    try {

dd('h');
    } catch (Exception $exception) {
        Log::error($exception);
        return $exception;
    }
}


/**
 * customize validation rule for user registration with installer
 * @return array
 * @author Hitesh Kumar <Hitesh.kumar@ladybirdweb.com>
 */
function validationForCreateUserInstaller()
{
    try {
      dd('yha');
    } catch (Exception $exception) {
        Log::error($exception);
        return [];
    }
}

/**
 * write your form validation to validate the request for license code
 * make sure you enabled this feature in env
 * @return array
 * @author Hitesh Kumar <Hitesh.kumar@ladybirdweb.com>
 */
function validationRulesForLicenseCode(){
    try {
        return [

        ];
    } catch (Exception $exception) {
        Log::error($exception);
        return [];
    }
}

/**
 * write your custom logic here to validate license-code or serial key
 * make sure you enabled this feature in env
 * @return Exception
 */
function validateLicenseCodeOfUser(){
    try {

    } catch (Exception $exception) {
        Log::error($exception);
        return $exception;
    }
}

