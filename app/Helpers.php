<?php

/**
 * Detect Active Route.
 *
 * @param string $route
 * @param string $output
 *
 * @return string
 */
function isActiveRoute($route, $output = "active") {
    if (Route::currentRouteName() === $route) {
        return $output;
    }
}

/**
 * Detect Active Routes.
 *
 * @param array $routes
 * @param string $output
 *
 * @return string
 */
function areActiveRoutes(Array $routes, $output = "active") {
    foreach ($routes as $route) {
        if (Route::currentRouteName() === $route) {
            return $output;
        }
    }
}

/**
 * Detect Active Paths.
 * 
 * @param array $paths
 * @param string $output
 * 
 * @return string
 */
function isActivePaths($path, $output = "active") {
    if (Request::is($path)) {
        return $output;
    }
}

/**
 * Detect Active Paths.
 * 
 * @param array $paths
 * @param string $output
 * 
 * @return string
 */
function areActivePaths(Array $paths, $output = "active") {
    foreach ($paths as $path) {
        if (Request::is($path)) {
            return $output;
        }
    }
}

/**
 * Returns formatted date.
 *
 * @param string $date
 * @param string $format
 *
 * @return string
 */
function formatDate($date, $format = "d-m-Y") {
    return date($format, strtotime($date));
}

/**
 * Converts an array to string.
 * 
 * @param array $array
 * @param string $glue
 * 
 * @return string
 */
function arrayToString(Array $array = [], $glue = ", ") {
    return collect($array)->implode($glue);
}

/**
 * Checks if view file exists or not.
 * 
 * @param string $view
 * 
 * @return boolean
 */
function view_exists($view) {
    return View::exists($view);
}

/**
 * Checks the application environment.
 * 
 * @param string $environment
 * 
 * @return boolean
 */
function isEnvironment($environment) {
    return app()->environment($environment);
}

/**
 * Returns the authenticated user.
 *
 * @return array
 */
function getAuthenticatedUser() {
    return Auth::user();
}

/**
 * Returns true or false if user is authenticated or not.
 *
 * @return boolean
 */
function isAuthenticUser() {
    return Auth::check();
}

/**
 * Returns the form field value.
 * 
 * @param object $object
 * @param string $key
 * 
 * @return string
 */
function getFormFieldValue($object, $key) {
    $value = null;
    if (old($key)) {
        $value = old($key);
    } elseif (is_object($object) && isset($object->$key)) {
        $value = $object->$key;
    }
    return $value;
}

/**
 * 
 * @return type
 */
function getCmsPageNav() {
    return App::make('App\Http\Controllers\PageController')->getAllPages();
}
