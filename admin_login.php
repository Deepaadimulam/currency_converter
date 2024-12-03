<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query the database for admin
    $query = "SELECT * FROM users WHERE email = ? AND role = 'admin'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = 'admin';

            header('Location: admin_dashboard.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Currency Converter Heading */
        .currency-converter-heading {
            color: white;  /* White color for the heading */
            text-align: center;  /* Center align the heading */
            font-size: 2.5rem;  /* Adjust the font size */
            position: absolute;  /* Position it absolutely */
            left: 50%;  /* Move to the middle horizontally */
            transform: translateX(-50%);  /* Adjust the position to make sure it's exactly centered */
            top: 2rem;  /* Space from the top */
            margin-bottom: 2rem;  /* Add space below the heading */
        }

        /* Admin Login Form Styling */
        .container {
            text-align: center;
            margin-top: 5rem;
        }

        .container h2 {
            font-size: 2rem;
            color: #003366; /* Dark Blue color for the heading */
        }

        .container input {
            margin: 10px;
            padding: 10px;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .container button {
            margin: 10px;
            padding: 10px;
            background-color: #003366; /* Dark Blue button */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 80%;
        }

        .container button:hover {
            background-color: #002244; /* Darker blue on hover */
        }

        .container p {
            font-size: 1rem;
        }

        .container .error {
            color: red;
            font-size: 1rem;
        }

        /* Style the links with dark blue */
        .container a {
            color: #003366;  /* Dark Blue color for links */
            text-decoration: none;  /* Remove underline */
            font-weight: bold;  /* Make the links bold */
        }

        .container a:hover {
            color: #002244;  /* Darker blue on hover */
        }
    </style>
</head>
<body>

    <!-- Currency Converter Heading -->
    <h2 class="currency-converter-heading">Currency Converter</h2>

    <div class="container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST" action="admin_login.php">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
    </div>

</body>
</html>
