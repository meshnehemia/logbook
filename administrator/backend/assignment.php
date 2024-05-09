<?php
// Initialize the session
session_start();

// Include database configuration
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

// Check if the assignment table exists
$check_table_sql = "SHOW TABLES LIKE 'assignment'";
$result = $conn->query($check_table_sql);
if ($result->num_rows == 0) {
    // Create the assignment table if it doesn't exist
    $sql = "CREATE TABLE assignment (
        student_id INT NOT NULL,
        lecture_id INT NOT NULL,
        FOREIGN KEY (student_id) REFERENCES student(student_id),
        FOREIGN KEY (lecture_id) REFERENCES lecture(lecture_id),
        PRIMARY KEY (student_id, lecture_id)
    )";
    
    if ($conn->query($sql) === TRUE) {
        //echo "Table assignment created successfully";
    } else {
        //echo "Error creating table assignment: " . $conn->error;
    }
} else {
    //echo "Table assignment already exists";
}

// Close the database connection
$conn->close();

