<?php
session_start();
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    admin_no VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    //echo "Table 'student' created successfully or already exists.";
} else {
    //echo "Error in creating table student: " . $conn->error;
}

$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $user_id;
    $course_name = $_POST['course_name'];
    $admin_no = $_POST['admin_no'];

    // Check if the student already exists in the database.
    $sql = "SELECT student_id FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();

    if ($exists) {
        // Update the student record.
        $updateSql = "UPDATE student SET course_name= ?, admin_no= ? WHERE student_id= ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi",$course_name, $admin_no, $student_id);
        if ($updateStmt->execute()) {
          //  echo "Student record updated successfully";
        } else {
          //  echo "Error updating student record: " . $conn->error;
        }
        $updateStmt->close();
    } else {
        // Insert the student record.
        $insertSql = "INSERT INTO student (student_id, course_name, admin_no) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iss", $student_id,$course_name, $admin_no);
        if ($insertStmt->execute()) {
            //echo "New student record created successfully";
        } else {
           // echo "Error creating student record: " . $conn->error;
        }
        $insertStmt->close();
    }
} else {
    // Display the student's details for viewing.
    $sql = "SELECT * FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
         //   echo "Student ID: " . $row["student_id"] . "<br>";
          //  echo "Course Name: " . $row["course_name"] . "<br>";
          //  echo "Admin No: " . $row["admin_no"] . "<br>";
        }
    } else {

    }
    $stmt->close();
}
$conn->close();
header("Location: ../fronted/profile.php");