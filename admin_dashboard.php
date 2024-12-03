<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

// Fetch all users
$result = $conn->query("SELECT * FROM users");

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $conn->query("DELETE FROM users WHERE id = $userId");
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: url('currency.jpg') no-repeat center center/cover;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin: 20px 0;
            font-size: 2.5rem;
            text-align: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* Layout Styles */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .user-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .user-card {
    background: #ffffff; /* Pure white background */
    color: #000;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}


        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
        }

        .profile-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #003366;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 15px;
        }

        .user-info {
            text-align: center;
            margin-bottom: 15px;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 1rem;
            color: #000;
        }

        /* Delete Button (Dark Blue) */
.delete-btn {
    background-color: #003366;  /* Dark Blue background */
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.delete-btn:hover {
    background-color: #002244;  /* Slightly darker blue on hover */
}

/* Logout Button (Dark Blue) */
.logout-btn {
    margin-top: 20px;
    background-color: #003366;  /* Dark Blue background */
    border: none;
    padding: 10px 20px;
    font-size: 1.2rem;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background 0.3s ease;
    text-decoration: none;
}

.logout-btn:hover {
    background-color: #002244;  /* Slightly darker blue on hover */
}

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            .user-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="user-cards">
            <?php while ($user = $result->fetch_assoc()) { ?>
                <div class="user-card">
                    <div class="profile-icon">
                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="delete" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>