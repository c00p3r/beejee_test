<?php

require 'vendor/autoload.php';

if (!function_exists('env')) {
    function env($name, $default = null)
    {
        if (($value = getenv($name)) === false) {
            $value = $default;
        }
        if ($value == 'true') {
            $value = true;
        }
        if ($value == 'false') {
            $value = false;
        }

        return $value;
    }
}

(new \Dotenv\Dotenv(__DIR__))->load();

if (!defined('ROOT')) {
    define('ROOT', __DIR__);
}
