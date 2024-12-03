<?php
session_start();
require_once 'db_connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
         // Assign a default role
         $role = 'user'; // Default role

         // Insert into database
         $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
 
         if ($stmt->execute()) {
             header("Location: signin.php");
             exit();
         } else {
             $errors[] = "Failed to register. Try again.";
         }
     }
 }
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="style.css" rel="stylesheet">
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

        /* Sign Up Form Styling */
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
            background-color: #002244; /* Darker Blue on hover */
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
            color: #002244;  /* Darker Blue on hover */
        }
    </style>
</head>
<body>

    <!-- Currency Converter Heading -->
    <h2 class="currency-converter-heading">Currency Converter</h2>

    <div class="container">
        <h2>Sign Up</h2>
        <?php if (!empty($errors)) { ?>
            <div class="error"><?php echo implode("<br>", $errors); ?></div>
        <?php } ?>
        <form method="POST" action="signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="signin.php">Sign in here</a></p>
        <p>Admin? <a href="admin_login.php">Log in here</a></p>
    </div>

</body>
</html>
