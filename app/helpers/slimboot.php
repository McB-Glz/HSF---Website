<?php

/*
 * Allow to access config keys in a dot fashion way, e.g.:
 * config('l10n.locales.other') instead $app->config('l10n')['locales']['other'];
 */
if (!function_exists('config')) {
    function config($path, $default = null)
    {
        try {
            global $app;
            $keyPaths = explode('.', trim($path));
            if (count($keyPaths) == 0) {
                return;
            }
            $config = $app->config(array_shift($keyPaths));
            while (!empty($keyPaths)) {
                $config = $config[array_shift($keyPaths)];
            }

            return $config;
        } catch (Exception $e) {
            if (null !== $default) {
                return $default;
            }
            throw $e;
        }
    }
}

/*
 * trim() with extra characters.
 */
if (!function_exists('xtrim')) {
    function xtrim($string, $extraCharacters = '')
    {
        return trim($string, " \t\n\r\0\x0B".$extraCharacters);
    }
}

/*
 * The loved dump and die function.
 */
if (!function_exists('dd')) {
    function dd()
    {
        call_user_func_array('var_dump', func_get_args());
        die;
    }
}

// Append your helpers here or create a file with any name in the same directory this file is, it will be automatically
// loaded
