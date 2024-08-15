<?php
// Include the database connection file
include 'connection/db_connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // Basic validation (you should enhance this)
    if (empty($email) || empty($password)) {
        // Handle empty fields error
        echo "Please fill in both email and password.";
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    // Simulate authentication (replace with actual database authentication)
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $email_db = $row['email'];
            $password_db = $row['password'];

            if ($email == $email_db && $password == $password_db) {
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                echo "Incorrect Password";
            }
        }
    } else {
        echo "User Not Found.";
    }
} else {
    // Redirect back to login page if accessed directly
    header("Location: ../login.php");
    exit;
}

