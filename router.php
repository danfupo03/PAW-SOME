<?php
define('BASE_URL', '/PAW-SOME/');

$routes = [
    '/' => 'views/home.php',
    '/about' => 'views/about.php',
    '/customer' => 'views/customer.php',
    '/login' => 'views/login.php',
    '/register' => 'views/register.php',
    '/logout' => 'views/logout.php',
    '/product' => 'views/product.php',
    '/productList' => 'views/productList.php'
];

function runRoute($route)
{
    global $routes;

    if (array_key_exists($route, $routes)) {
        require $routes[$route];
    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
}
