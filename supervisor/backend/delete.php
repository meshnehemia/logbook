<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);


if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];
    $stmt = $conn->prepare("DELETE FROM attachment WHERE student_id = ?");
$stmt->bind_param("i", $studentId);
if ($stmt->execute()) {
    echo $studentId;
} else {
   // echo "Error deleting record: " . $conn->error;
}
} else {
   // echo "Student ID not provided";
}