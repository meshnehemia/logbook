<?php
session_start();
include('../../login/database/databaseconfig.php');
$email = $_POST['email'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$type = $_POST['register'];
$gender = $_POST['gender'];
if ($password !== $password2) {
    echo "Passwords do not match!";
    exit();
}
$dbname = "logbook";
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        mysqli_select_db($conn, $dbname);
    } else {
        die("Error creating database: " . $conn->error);
    }
$sqlTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type ENUM('admin', 'student' , 'lecturer','supervisor') NOT NULL,
    gender ENUM('male', 'female', 'others') NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($sqlTable) === TRUE;
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "email exist";
        exit();
    }
$sqlInsert = "INSERT INTO users (email, first_name, last_name, password, type, gender) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
if ($stmt) {
    $stmt->bind_param("ssssss", $email, $first_name, $last_name, $hashed_password, $type, $gender);
    if ($stmt->execute()) {
        // $_SESSION['user_fname'] = $first_name;
        // $_SESSION['user_lname'] = $last_name;
        // $_SESSION["user_type"] = $type;
        // $_SESSION['user_type'] = $type;
        // $_SESSION['user_id'] = $row['id'];
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
$conn->close();
?>
