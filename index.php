<?php
define('BASE_URL', '/PAW-SOME/');
require_once 'router.php';

$route = $_GET['route'] ?? '/';
runRoute($route);
