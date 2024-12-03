<?php
// Database configuration
define('DB_SERVER', 'localhost');    // Your database server
define('DB_USERNAME', 'root');       // Your database username
define('DB_PASSWORD', '');           // Your database password
define('DB_NAME', 'currency_converter'); // Your database name

// Connect to the database
function getDbConnection() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Currency API configuration (Optional)
define('CURRENCY_API_URL', 'https://open.er-api.com/v6/latest');

// Session settings (if you want to customize session handling)
session_start();  // Start the session for user authentication
