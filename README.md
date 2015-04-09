# Slimboot-localized

Small boilerplate for PHP website with assets compilers and localization ready.

Includes

- Slim Framework
- Twig Templates
- Laravel Elixir
- Easy to configure for multiple locales


## How to use multilang

- Configure the locales you want to support inside `app/config/l10n.php`.
- Create a dir for each locale inside `lang/` (with the locale as the dir name).
- Create a `.php` file named as the slug of the page you want to translate.
- In the lang file add an associative array with all the translations you need.
- Create your routes without the locale segment, i.e. `$app->get('/hello', ...)` instead `$app->get('/en/hello', ...)`
- If you add a `global.php` file in a lang dir, it will be automatically loaded in any route with the locale segment.

## How does this work?

When you type an url prefixed with a valid locale, it will be detected and ignored by the app routing functions (`$app->get()`, etc) so, if you type `/en/hello`, being `en` a valid locale, the `$app->get('/hello', ...)` route will be called,
It then will look for the `lang/en/hello.php` to get the translated strings and finally inject them in the view. This means that you can have two routes (e.g. `/hello` `/hola`) using the same template,
so creating the file `lang/es/hola` will make those.
Also, a _TWIG_ variable `locale` is automatically injected containing the locale if found.


## Autolading files

The `.php` files inside `app/config`, `app/helpers`, `app/hooks` and `app/middlewares` will be automatically loaded, just add the files with the correct structure.


## Available helpers

| Function                                      | Description                                                               |
|-----------------------------------------------|---------------------------------------------------------------------------|
| `dd('arg1', ...)`                             | Executes a `var_dump` with any number of parameters and then calls `die`. |
| `config('file.key.subkey.otherkey', default)` | Gets a config setting using _dot notation_.                               |
| `xtrim(variableToTrim, extraCharsToRemove)`   | Executes a trim removing also any character in the second parameter.      |


## The twig extension

The loaded twig extension overrides the original `urlFor()` method from the `slim/views` dependency, receiving a custom locale as third parameter and a custom application name as the fourth one. [More info here](http://docs.slimframework.com/#Route-Names)
# HSF---Website
