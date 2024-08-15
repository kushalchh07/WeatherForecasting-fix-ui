<?php
// Include the database connection file
include 'connection/db_connect.php';

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password
function isValidPassword($password) {
    // Check password length (example: minimum 8 characters)
    return strlen($password) >= 8;
}

// Function to check if email is already registered
function isEmailRegistered($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }
    if (!isValidEmail($email)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }
    if (!isValidPassword($password)) {
        echo "<script>alert('Password must be at least 8 characters long.'); window.history.back();</script>";
        exit;
    }
    if (isEmailRegistered($conn, $email)) {
        echo "<script>alert('Email is already registered.'); window.history.back();</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = sha1($password);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Use JavaScript to display a popup and redirect to the login page
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect back to registration page if accessed directly
    header("Location: register.php");
    exit;
}

// Close the database connection
$conn->close();
?>
