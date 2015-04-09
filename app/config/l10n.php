<?php

//
// The lang file. For modify/add/remove locales you must have a directory with the locale name inside app/lang for
// each locale configured here.
// As the mechanism of autoloading all config files of the config dir uses the filename to contain the config data
// if you rename this file, you must update all config('l10n...') / $app->config('l10n') calls.
// The localization hook contains a call to this file.
//

return [
    'locales' => [
        'es',
        'en',
    ],
];
