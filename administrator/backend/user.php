<?php 
    session_start();
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, first_name, last_name, password, type, gender) VALUES (?,?, ?, ?, ?, ?)";

        // Check if the email already exists
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $email = $_POST['email'];
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows == 0) { // Email doesn't exist, proceed with insertion
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param("ssssss", $email, $first_name, $last_name, $hashed_password, $type, $gender);

                // Set parameters
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $password = $_POST['password'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
                $type = $_POST['type'];
                $gender = $_POST['gender'];

                // Execute prepared statement
                if ($stmt->execute()) {
                    echo "Records inserted successfully.";
                } else {
                    echo "Error inserting records: " . $conn->error;
                }

                // Close statement
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "The email already exists. Please use a different email address.";
        }
    } else {
        echo "Please submit the form.";
    }
    header("Location: ../fronted/deleteuser.php");