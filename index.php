<?php
require_once __DIR__ . '/router.php';

$route = $_GET['route'] ?? '/';
runRoute($route);
