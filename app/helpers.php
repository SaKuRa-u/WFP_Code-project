<?php

if (!function_exists('activeRoute')) {
    function activeRoute($route, $class = 'active')
    {
        if ($route === 'root') {
            return request()->is('/') ? $class : '';
        }

        return request()->routeIs($route) || request()->routeIs($route . '*')
            ? $class
            : '';
    }
}