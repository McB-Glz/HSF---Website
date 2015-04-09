<?php

/**
 * @var string root of the app.
 */
$rootPath = dirname(__DIR__);
$appPath = $rootPath.'/app';

// Load the composer autoloader
require $rootPath.'/vendor/autoload.php';

/*
 * Load bootstrap script. That file is the place to add any config, or middleware.
 * In that file you can customize your application, add middleware scripts, etc.
 * This is used then in the app.php file for routing.
 *
 * @var \Slim\Slim The slim application.
 */
$app = require $rootPath.'/core/bootstrap.php';

// Load the application (or routes) file...
require $rootPath.'/app/app.php';

// ... and run it
$app->run();
