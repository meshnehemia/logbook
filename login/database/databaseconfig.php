<?php 
    $username = "root";
    $servername = "localhost";
    $password = "2254";
    $conn = mysqli_connect($servername,$username,$password);
    if($conn){
        
    }else {
         echo "failed to connect";
    }
    $dbname = "logbook";
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        mysqli_select_db($conn, $dbname);
    } else {
        die("Error creating database: " . $conn->error);
    }
    $dbname = "logbook";
    $conn->select_db($dbname);
     $sqlTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type ENUM('admin', 'student' , 'lecturer','supervisor') NOT NULL,
    gender ENUM('male', 'female', 'others') NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conn->query($sqlTable);
   
   
     $sql = "CREATE TABLE IF NOT EXISTS lecstudent (
          lecturer_id INT NOT NULL,
          student_id INT NOT NULL
      )";
      if ($conn->query($sql) === TRUE) {
        //  echo "Table assignment created successfully";
      } else {
         // echo "Error creating table assignment: " . $conn->error;
      }
      $sql = "CREATE TABLE IF NOT EXISTS company (
          company_id INT AUTO_INCREMENT PRIMARY KEY, 
          company_name VARCHAR(255) NOT NULL, 
          location VARCHAR(255) NOT NULL, 
          supervisor_id INT NOT NULL
      )";
      $conn->query($sql);
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
        //  echo "Table 'log_books' created successfully or already exists.";
      } else {
         // echo "Error creating table: " . $conn->error;
      }
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
     //  $sql = "CREATE TABLE IF NOT EXISTS company (
     //      company_id INT AUTO_INCREMENT PRIMARY KEY, 
     //      company_name VARCHAR(255) NOT NULL, 
     //      location VARCHAR(255) NOT NULL, 
     //      supervisor_id INT NOT NULL, 
     //      FOREIGN KEY (supervisor_id) REFERENCES users (user_id)
     //  )";
      
     //  if ($conn->query($sql) === TRUE) {
     //      //echo "Table 'company' created successfully or already exists.";
     //  } else {
     //      //echo "Error in creating table company: " . $conn->error;
     //  }
     //  $sql = "CREATE TABLE IF NOT EXISTS company (
     //      company_id INT AUTO_INCREMENT PRIMARY KEY, 
     //      company_name VARCHAR(255) NOT NULL, 
     //      location VARCHAR(255) NOT NULL, 
     //      supervisor_id INT NOT NULL
     //  )";
      
     //  if ($conn->query($sql) === TRUE) {
     //      //echo "Table 'company' created successfully or already exists.";
     //  } else {
     //      //echo "Error in creating table company: " . $conn->error;
     //  }
      $sql= "CREATE TABLE IF NOT EXISTS attachment (
          att_id INT AUTO_INCREMENT PRIMARY KEY, 
          company_id INT NOT NULL, 
          student_id INT, 
          start_date DATE,
          duration VARCHAR(30)
      )";
      
      if ($conn->query($sql) === TRUE) {
        //echo "Table attachment created successfully.";
      } else {
        //echo "Error in creating table attachment " . $conn->error;
      }
      $check_table_sql = "SHOW TABLES LIKE 'assignment'";
      $result = $conn->query($check_table_sql);
      if ($result->num_rows == 0) {
      // Create the assignment table if it doesn't exist
      $sql = "CREATE TABLE assignment (
           student_id INT NOT NULL,
           lecture_id INT NOT NULL,
           PRIMARY KEY (student_id, lecture_id)
      )";
      if ($conn->query($sql) === TRUE) {
           //echo "Table assignment created successfully";
      } else {
          // echo "Error creating table assignment: " . $conn->error;
      }
      } else {
      //echo "Table assignment already exists";
      }
$email = "nehemiamesh@gmail.com";
$first_name = "Meshack";
$last_name = "Nehemia";
$raw_password = "@mesh1234";
$type = "admin";
$gender = "male";

$password = password_hash($raw_password, PASSWORD_DEFAULT);

$checkEmailSql = "SELECT id FROM users WHERE email = ?";
$checkStmt = $conn->prepare($checkEmailSql);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows == 0) {
    $sql = "INSERT INTO users (email, first_name, last_name, password, type, gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $email, $first_name, $last_name, $password, $type, $gender);
    $stmt->execute();
    $stmt->close();
}
$checkStmt->close();
