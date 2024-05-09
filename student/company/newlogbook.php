<?php
session_start();
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);
$sql = "CREATE TABLE IF NOT EXISTS log_books (
    student_id INT NOT NULL,
    logbook_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    work_done VARCHAR(1000) NOT NULL,
    new_skills VARCHAR(200) NOT NULL,
    supervisor_score DECIMAL(5,2) NULL,
    assessment TEXT,
    assessment_score VARCHAR(1000)  NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'log_books' created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $date = $_POST['date'];
    $work_done = $_POST['work_done'];
    $new_skills = $_POST['new_skills'];
    $studentId = $_SESSION['user_id']; // Assuming user_id is stored in the session

    // Prepare an SQL statement to insert the data
    $sql = "INSERT INTO log_books (student_id, date, work_done, new_skills, supervisor_score, assessment_score) VALUES (?, ?, ?, ?, NULL, NULL)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind the parameters and execute the statement
    $stmt->bind_param("isss", $studentId, $date, $work_done, $new_skills);
    if ($stmt->execute()) {
        header('Location: ../fronted/logbook.php');
    } else {
        echo "Error submitting logbook entry: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please submit the form.";
}
$conn->close();
