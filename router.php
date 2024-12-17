<?php
$routes = [
    '/' => __DIR__ . '/views/home.php',
    '/about' => __DIR__ . '/views/about.php',
    '/customer' => __DIR__ . '/views/customer.php',
    '/login' => __DIR__ . '/views/login.php',
    '/autenticate' => __DIR__ . '/views/autenticate.php',
    '/register' => __DIR__ . '/views/register.php',
    '/logout' => __DIR__ . '/views/logout.php',
    '/product' => __DIR__ . '/views/product.php',
    '/productList' => __DIR__ . '/views/productList.php',
    '/comparison' => __DIR__ . '/views/comparison.php',
    '/shoppingCart' => __DIR__ . '/views/shoppingCart.php',
    '/users' => __DIR__ . '/views/users.php',
    '/orders' => __DIR__ . '/views/orders.php',
    '/order' => __DIR__ . '/views/order.php',
    '/404' => __DIR__ . '/views/404.php',
];


function runRoute($route)
{
    global $routes;

    if (array_key_exists($route, $routes) && file_exists($routes[$route])) {
        require $routes[$route];
    } else {
        http_response_code(404);
        require __DIR__ . '/views/404.php'; 
    }
}
