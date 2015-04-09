<?php

namespace Slimboot;

use Slim\Slim;
use Slim\Views\TwigExtension as SlimTwigExtension;

class TwigExtension extends SlimTwigExtension
{
    public function getName()
    {
        return 'slim';
    }

    public function urlFor($name, $params = [], $locale = null, $appName = 'default')
    {
        return Slim::getInstance($appName)->urlFor($name, $params, $locale);
    }

    public function currentUrl($withQueryString = true, $appName = 'default')
    {
        $app = Slim::getInstance($appName);
        $req = $app->request();
        $locale = $app->view()->get('locale');

        $uri = $req->getUrl().($locale ? "/$locale" : '').$req->getPath();

        if ($withQueryString) {
            $env = $app->environment();

            if ($env['QUERY_STRING']) {
                $uri .= '?'.$env['QUERY_STRING'];
            }
        }

        return $uri;
    }
}
