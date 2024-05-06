<?php

use Illuminate\Support\Facades\Route;



if (!function_exists('isActiveRoute')) {
    /**
     * Check if the given route is the current route.
     *
     * @param  string|array  $route
     * @param  string  $class
     * @return string
     */
    function isActiveRoute($route, $class = 'active')
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (Route::is($r)) {
                    return $class;
                }
            }
        } else {
            if (Route::is($route)) {
                return $class;
            }
        }

        return '';
    }
}
