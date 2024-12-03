<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Menu Bar */
        .menu-bar {
            position: absolute;
            top: 1rem;
            left: 1rem;
            cursor: pointer;
            z-index: 10;
        }

        .menu-bar i {
            font-size: 1.5rem;
            color: #ffffff; /* Dark Blue color for the menu icon */
        }

        /* Sidebar (Dropdown) */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 250px;
            background-color:  #003366; /* Dark Blue background */
            transition: left 0.3s ease;
            padding-top: 3rem;
            z-index: 5;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.3);
        }

        .sidebar.active {
            left: 0; /* Shows the sidebar when active */
        }

        .sidebar a {
            text-decoration: none;
            color: white; /* White text for links */
            padding: 1rem;
            display: block;
            text-align: center;
            font-size: 1.2rem;
        }

        .sidebar a:hover {
            background-color: #002244; /* Darker blue on hover */
        }

        /* Currency Converter Heading Styling */
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
        
        /* Container Styling */
        .container {
            background: rgba(255, 255, 255, 0.85); /* Slight transparency */
            padding: 2rem;
            text-align: center;
            border-radius: 1rem;
            width: 90%; /* Responsive width */
            max-width: 400px; /* Limit the maximum width */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow for better focus */
        }

        .container h1 {
            font-size: 2rem;
            color: #003366; /* Dark Blue color for the user greeting */
        }

        /* Button styling */
        form button {
            height: 3rem;
            background-color: #003366; /* Dark Blue button */
            color: white;
            font-size: 1.15rem;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 1rem;
        }

        form button:hover {
            background-color: #002244; /* Darker blue on hover */
        }

        .msg {
            margin-top: 1rem;
            font-size: 1rem;
            color: #003366; /* Dark Blue color for the exchange rate message */
        }

        /* Form styling */
        .amount, .dropdown {
            margin-bottom: 1rem;
        }

        .select-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .select-container img {
            margin-right: 10px;
        }

        .dropdown {
            display: flex;
            justify-content: space-between;
        }

        .dropdown select {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        /* Menu Bar Icon */
        .fa-bars {
            color: #003366; /* Dark Blue color for the menu bar icon */
        }

    </style>
</head>
<body>

    <div class="menu-bar" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </div>

    <div class="sidebar" id="sidebar">
        <a href="logout.php">Logout</a>
    </div>

    <!-- Currency Converter Heading -->
    <h2 class="currency-converter-heading">Currency Converter</h2>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

        <form>
            <div class="amount">
                <p>Enter Amount</p>
                <input value="1" type="text" />
            </div>
            <div class="dropdown">
                <div class="from">
                    <p>From</p>
                    <div class="select-container">
                        <img src="https://flagsapi.com/US/flat/64.png" />
                        <select name="from"></select>
                    </div>
                </div>
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                <div class="to">
                    <p>To</p>
                    <div class="select-container">
                        <img src="https://flagsapi.com/IN/flat/64.png" />
                        <select name="to"></select>
                    </div>
                </div>
            </div>
            <div class="msg">1 USD = 80 INR</div>
            <button type="button">Get Exchange Rate</button>
        </form>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
    <script src="codes.js"></script>
    <script src="app.js"></script>
</body>
</html>
