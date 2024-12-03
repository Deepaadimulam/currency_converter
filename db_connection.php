<?php
$host = 'localhost'; // or '127.0.0.1'
$user = 'root';      // Default XAMPP username
$password = '';      // Default XAMPP password is empty
$database = 'currency_converter';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
