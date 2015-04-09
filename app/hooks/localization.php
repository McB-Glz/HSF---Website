<?php

$app->hook('slim.before.router', function () use ($app) {
    global $rootPath;
    $env = $app->environment;
    $segments = explode('/', xtrim($app->request->getPathInfo(), '/'));
    $firstSegment = $segments[0];
    $locales = config('l10n.locales');

    // request has the first segment as locale, inject lang files.
    if (in_array($firstSegment, $locales)) {
        $path = xtrim($env->offsetGet('PATH_INFO'), '/');
        // generate the new path removing the locale segment
        $newPath = substr($path, strlen($firstSegment));
        // and set it again updated
        $env->offsetSet('PATH_INFO', !empty($newPath) ? $newPath : '/');

        $langDir = $rootPath.'/lang/'.$firstSegment.'/';

        $langFile = $langDir.'global.php';
        if (file_exists($langFile)) {
            $lang = require $langFile;
            $app->view()->appendData($lang);
        }

        $langFile = $langDir.$segments[1].'.php';
        if (file_exists($langFile)) {
            $lang = require $langFile;
            $app->view()->appendData($lang);
        }

        $app->view()->set('locale', $firstSegment);
    }
});
