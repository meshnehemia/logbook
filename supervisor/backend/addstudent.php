<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

// Retrieve form data
$admissionNo = $_POST['regnumber'];
$supervisorId = $_SESSION['user_id'];
$startDate = $_POST['date'];
$duration = $_POST['duration'];

// Retrieve student_id from the student table
$stmt = $conn->prepare("SELECT student_id FROM student WHERE admin_no = ?");
$stmt->bind_param("s", $admissionNo);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $studentId = $row['student_id'];
} else {
    header('Location: ../fronted/companyinfo.php');
}

// Check if the student_id is already in the attachment table
$stmt = $conn->prepare("SELECT * FROM attachment WHERE student_id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Handle the case where the student ID is already present
    // Option 1: Update the existing record
    // Option 2: Notify the user that the record exists and cannot be duplicated
    echo "A record for this student already exists.";
    // Optionally, include logic to update the record here if that's the desired behavior
} else {
    // If the student ID is not found in the attachment table, continue to retrieve company_id
    $stmt = $conn->prepare("SELECT company_id FROM company WHERE supervisor_id = ?");
    $stmt->bind_param("s", $supervisorId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $companyId = $row['company_id'];
    } else {
        header('Location: ../fronted/companyinfo.php');
    }

    // Insert data into the attachment table
    $stmt = $conn->prepare("INSERT INTO attachment (company_id, student_id, start_date, duration) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $companyId, $studentId, $startDate, $duration);
    if ($stmt->execute()) {
        header('Location: ../fronted/companyinfo.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
header('Location: ../fronted/companyinfo.php');
