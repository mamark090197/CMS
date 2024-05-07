<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "client_management";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate the username and password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        
        // Determine user role and redirect accordingly
        if ($row['role'] == 'admin') {
            header("Location: adminview.php");
            exit;
        } elseif ($row['role'] == 'user') {
            header("Location: client_crud.php");
            exit;
        } else {
            // Invalid role, redirect back to login with an error message
            $_SESSION['login_error'] = "Invalid role";
            header("Location: login.php");
            exit;
        }
    } else {
        // Authentication failed, redirect back to login with an error message
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php");
        exit;
    }
} else {
    // Redirect back to login if accessed directly
    header("Location: login.php");
    exit;
}
?>
