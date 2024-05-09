<?php 
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT student_id FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $row["student_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row["student_id"];

        // Get the logged-in user ID (assuming the user type is stored in the session)
        $lecturer_id = $_POST['lecture_id'];

        // Check if the record exists
        $sql_check = "SELECT * FROM lecstudent WHERE student_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i",$student_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            // Update the existing record
            $sql = "UPDATE lecstudent SET lecturer_id = ? WHERE student_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lecturer_id, $student_id);
            if ($stmt->execute()) {
                echo "Lec_student record updated successfully";
            } else {
                echo "Error updating lec_student record: " . $conn->error;
            }
            $stmt->close();
        } else {
            // Insert the new record
            $sql = "INSERT INTO lecstudent (lecturer_id, student_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lecturer_id, $student_id);
            if ($stmt->execute()) {
                echo "New lec_student record created successfully";
            } else {
                echo "Error creating lec_student record: " . $conn->error;
            }
            $stmt->close();
        }
        $stmt_check->close();
    }
}

$sql = "SELECT * FROM lecstudent";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["lecturer_id"] . "</td>";
        echo "<td>" . $row["student_id"] . "</td>";
        echo "</tr>";
    }
} else {
   // echo "0 results";
}
$conn->close();