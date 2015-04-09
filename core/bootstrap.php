<?php

////////////////////////////////////////////////////////////////////////// helpers

function requireDir($dir)
{
    // make $app variable visible for imported files
    global $app;
    foreach (glob("$dir/*.php") as $filename) {
        require $filename;
    }
}

function loadConfigs($dir)
{
    // make $app variable visible for calling its methods
    global $app;
    $configs = [];
    foreach (glob("$dir/*.php") as $filename) {
        $configKey = substr(basename($filename), 0, -4);
        $configs[$configKey] = require $filename;
    }
    $app->config($configs);
}

function loadMiddlewares($dir)
{
    // make $app variable visible for imported files
    global $app;
    foreach (glob("$dir/*.php") as $filename) {
        require $filename;
        $middlewareClassName = substr(basename($filename), 0, -4);
        $app->add(new $middlewareClassName());
    }
}

////////////////////////////////////////////////////////////////////////// generate application...

// Create an application instance with some default settings. Customize it!
$app = new \Slimboot\LocalizedSlim([
    'mode'              => 'local', // Can be set by $_ENV['SLIM_MODE'] = 'production';
    'templates.path'    => $rootPath.'/resources/views',
    'cookies.encrypt'   => false,
    'cookies.lifetime'  => '20 minutes',
]);

////////////////////////////////////////////////////////////////////////// ...and start bootstraping

// load helpers
requireDir($appPath.'/helpers');

// load configuration modes file
require $rootPath.'/core/configModes.php';

// load configs
loadConfigs($appPath.'/config');

// load hooks
requireDir($appPath.'/hooks');

// load middlewares
loadMiddlewares($appPath.'/middlewares');

// Configure Views
$app->view(new \Slim\Views\Twig());

$app->view->parserOptions = [
    'charset'          => 'utf-8',
    'cache'            => $rootPath.'/storage/templates',
    'auto_reload'      => true,
    'strict_variables' => false,
    'autoescape'       => true,
];

// Add custom twig extension prepared to work with locales
$app->view->parserExtensions = [new \Slimboot\TwigExtension()];

return $app;
