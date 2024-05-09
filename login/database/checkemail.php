<?php
session_start();
include('databaseconfig.php'); // Adjust the path as necessary
$dbname = "logbook";
$conn->select_db($dbname);

// Function to check if the email exists and the password is correct
function checkLogin($conn, $email, $password) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        echo "Email does not exist.";
        return false;
    }

    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_fname'] = $row['first_name'];
        $_SESSION['user_lname'] = $row['last_name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_type'] = $row['type'];
        $_SESSION['user_id'] = $row['id'];
        if($_SESSION['user_type']=="admin"){
            echo "welcome admin";
        }else if($_SESSION['user_type']=="student"){
            echo "welcome back student";
        }else if($_SESSION['user_type']=="lecturer"){
            echo "hello lecturer";
        }else if($_SESSION['user_type']=="supervisor"){
            echo "logging in as supervisor";
        }else{
            echo "Login success!";
        }
        return true;
    } else {
        echo "Incorrect password.";
        return false;
    }
}

// Assuming you're using POST method to submit the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (checkLogin($conn, $email, $password)) {
        // Login successful
        // Proceed with login success actions (e.g., creating a session, redirecting to another page)
    } else {
        // Login failed
        echo "login failed";
        // Handle the failure (e.g., displaying an error message, offering a password reset)
    }
}
?>
