

Setup Instructions
Step 1: Install XAMPP
Download and install XAMPP on your system.
After installation, launch the XAMPP Control Panel and start the Apache and MySQL services.
Step 2: Place Files in the Server Directory
Navigate to the htdocs folder in your XAMPP installation directory.
Typically located at C:\xampp\htdocs on Windows.
Copy the entire project folder (currency_converter) into the htdocs folder.
Step 3: Set Up the Database
Open your browser and go to http://localhost/phpmyadmin.

Create a new database named currency_converter.

Use the SQL tab in phpMyAdmin to execute the following SQL query to create the users table:
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert an admin user (replace `admin_password` with a hashed password)
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@example.com', 'admin_password', 'admin');
Update the INSERT query to include your admin credentials:

Replace admin@example.com with your admin email.
Replace admin_password with a hashed password. To hash a password:
Use PHP’s built-in password_hash function:
php
Copy code
echo password_hash('your_password', PASSWORD_DEFAULT);
Copy the hashed value and paste it into the password field.
Step 4: Configure the Database Connection
Open the db_connection.php file located in the project folder.
Update the database credentials to match your setup:
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = "";     // Default MySQL password (empty for XAMPP)
$dbname = "currency_converter";
Step 5: Run the Application
Open your browser and navigate to the application URLs:
Admin Login: http://localhost/currency_converter/admin_login.php
Test the application with your credentials.


