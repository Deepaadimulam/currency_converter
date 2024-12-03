<?php
require_once 'db_connection.php';

$plainPassword = '123456'; // Replace with the actual plain-text password
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT); // Hash the password

$query = "UPDATE users SET password = ? WHERE username = 'manasa'";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $hashedPassword);
$stmt->execute();

echo $stmt->affected_rows > 0 ? "Password updated successfully." : "Failed to update password.";
?>
