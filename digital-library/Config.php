<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'digital_library';
$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die('Database not connected');
}
session_start();
?>
