<?php

namespace Slimboot;

use Slim\Slim;

class LocalizedSlim extends Slim
{
    public function urlFor($name, $params = [], $locale = null)
    {
        $locale = $locale ?: $this->view()->get('locale');

        $baseRoute = parent::urlFor($name, $params);

        $subdirectory = config('app.subpath', '');
        if (!empty($subdirectory)) {
            $subdirectory = xtrim($subdirectory, '/');
            if (!empty($subdirectory)) {
                $subdirectory = '/'.$subdirectory;
                if (0 === strpos($baseRoute, $subdirectory)) {
                    $baseRoute = substr($baseRoute, strlen($subdirectory));
                }
            }
        }

        return $locale
            ? sprintf('%s/%s%s', $subdirectory, $locale, $baseRoute)
            : parent::urlFor($name, $params);
    }
}
