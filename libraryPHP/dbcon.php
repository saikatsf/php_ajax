<?php
$host = 'localhost';
$db = 'phpajax';
$username = 'root';
$password = '';

$mysqli = new mysqli($host, $username, $password, $db);

 if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

?>