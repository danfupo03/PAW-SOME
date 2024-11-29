<?php
require_once 'router.php';

$route = str_replace(BASE_URL, '', $_GET['route'] ?? '/');
runRoute($route);
