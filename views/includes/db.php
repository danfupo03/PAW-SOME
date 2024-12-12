<?php
$host = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$dbname = "pawsome";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
