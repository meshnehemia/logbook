<?php
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$st_information="";
$conn->select_db($dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logbook_id = $_POST['logbook_id'];
    $supervisor_score = $_POST['supervisor_score'];
    $assessment = $_POST['comment'];
    echo $assessment;

    // Prepare the update statement
    $sql = "UPDATE log_books SET supervisor_score = ?, assessment = ? WHERE logbook_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $supervisor_score, $assessment, $logbook_id);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Logbook updated successfully";
    } else {
        echo "Error updating logbook: " . $conn->error;
    }

    $stmt->close();
}
header("Location: ../fronted/logbook.php");