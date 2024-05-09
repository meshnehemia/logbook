<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);


if (isset($_POST['Id'])) {
    $Id = $_POST['Id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $Id);
if ($stmt->execute()) {
   // echo $Id;
} else {
    //echo "Error deleting record: " . $conn->error;
}
} else {
   // echo "Student ID not provided";
}