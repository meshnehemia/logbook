<?php 
session_start();
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

if ($conn->query($sql) === TRUE) {
    //echo "Table 'company' created successfully or already exists.";
} else {
    //echo "Error in creating table company: " . $conn->error;
}

$supervisor_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $location = $_POST['company_location'];

    // Check if the company already exists in the database.
    $sql = "SELECT supervisor_id FROM company WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supervisor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();

    if ($exists) {
        // Update the company record.
        $updateSql = "UPDATE company SET company_name = ?, location = ? WHERE $supervisor_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $company_name, $location, $supervisor_id);
        if ($updateStmt->execute()) {
            echo "Company record updated successfully";
        } else {
            echo "Error updating company record: " . $conn->error;
        }
        $updateStmt->close();
    } else {
        // Insert a new company record.
        $insertSql = "INSERT INTO company (company_name, location, supervisor_id) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssi", $company_name, $location, $supervisor_id);
        if ($insertStmt->execute()) {
            echo "New company record created successfully";
        } else {
            echo "Error creating company record: " . $conn->error;
        }
        $insertStmt->close();
    }
} else {
    // Display the company's details for viewing.
    $sql = "SELECT * FROM company WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Company Id: " . $row["company_id"] . "<br>";
            echo "Company name: " . $row["company_name"] . "<br>";
            echo "Location: " . $row["location"] . "<br>";
            echo "Supervisor: " . $row["supervisor_id"] . "<br>";
        }
    } else {
        echo "No company record found";
    }
    $stmt->close();
}
$conn->close();
header('Location: ../fronted/companyinfo.php');

