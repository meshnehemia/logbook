<?php
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
    $conn->select_db($dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the logbook_id and new assessment score from the form
    $logbook_id = $_POST['logbook_id'];
    $assessment_score = $_POST['assessment_score'];
    echo $assessment_score;

    // Prepare the update statement
    $sql = "UPDATE log_books SET assessment_score = ? WHERE logbook_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $assessment_score, $logbook_id);

    // Execute the update statement
    if ($stmt->execute()) {
       // echo "Logbook updated successfully";
    } else {
       // echo "Error updating logbook: " . $conn->error;
    }
}
header("Location: ../fronted/assigned_students.php");