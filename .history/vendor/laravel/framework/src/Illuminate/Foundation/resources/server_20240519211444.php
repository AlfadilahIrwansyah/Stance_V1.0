<?php

// $publicPath = getcwd();

// $uri = urldecode(
//     parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
// );

// // This file allows us to emulate Apache's "mod_rewrite" functionality from the
// // built-in PHP web server. This provides a convenient way to test a Laravel
// // application without having installed a "real" web server software here.
// if ($uri !== '/' && file_exists($publicPath.$uri)) {
//     return false;
// }

// require_once $publicPath.'/index.php';

$publicPath = __DIR__.'/../public';

if (php_sapi_name() === 'cli-server') {
    // This file allows us to emulate Apache's "mod_rewrite" functionality from the built-in PHP web server.
    $url = parse_url($_SERVER['REQUEST_URI']);

    // This is to prevent serving .php files directly from the "public" directory
    $requestPath = rtrim($publicPath.$url['path'], '/');

    if (file_exists($requestPath) && is_file($requestPath)) {
        return false;
    }
}

require_once $publicPath.'/index.php';

