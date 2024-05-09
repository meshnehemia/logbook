<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

$supervisorId = $_SESSION["user_id"];
// SQL to fetch the required data
$sql = "SELECT u.first_name, u.last_name, s.admin_no,s.course_name, a.start_date, a.student_id, a.duration
        FROM users u
        JOIN company c ON u.id = c.supervisor_id
        JOIN attachment a ON c.company_id = a.company_id
        JOIN student s ON a.student_id = s.student_id
        WHERE u.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $supervisorId);
$stmt->execute();
$result = $stmt->get_result();
$display ="";
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $display .='<tr><td>'.$row["admin_no"].'</td>
        <td>'.$row["first_name"].' '.$row["last_name"].'</td>
        <td>'.$row['course_name'].'</td>
        <td>'. $row["start_date"].'</td>
        <td>'. $row["duration"].'<button style="padding:5px 10px; margin-left:60%; background-color:red; border-radius:5px;" onclick="deleteStudentRecord('.$row["student_id"].')">delete</button></td></tr>';
    }
} else {
    $display .='<td>none</td>
    <td>none</td>
    <td>none</td>
    <td>none</td>
    <td>none</td>';

}
