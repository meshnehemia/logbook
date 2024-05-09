<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);
$sql = "CREATE TABLE IF NOT EXISTS company (
    company_id INT AUTO_INCREMENT PRIMARY KEY, 
    company_name VARCHAR(255) NOT NULL, 
    location VARCHAR(255) NOT NULL, 
    supervisor_id INT NOT NULL, 
    FOREIGN KEY (supervisor_id) REFERENCES users (user_id)
)";
$conn->query($sql);
$sql = "SELECT c.company_name, u.first_name, u.last_name, a.start_date, a.duration, c.location
        FROM attachment a
        JOIN company c ON a.company_id = c.company_id
        JOIN users u ON c.supervisor_id = u.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row=$result->fetch_assoc();
    //while($row = $result->fetch_assoc()) {
        //echo "Company Name: " . $row["company_name"] . "<br>";
        //echo "Supervisor Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
        //echo "Starting Date: " . $row["start_date"] . "<br>";
        //echo "Duration: " . $row["duration"] . "<br><br>";
    //}
} else {
    $row["company_name"]="not assigned";
    $row["first_name"]="";
    $row["last_name"]="not assigned";
    $row["start_date"]="not assigned";
    $row["duration"]="not assined";
    $row['location']="none";
}
