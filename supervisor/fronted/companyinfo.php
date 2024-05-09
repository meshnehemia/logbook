<?php 
session_start();
include_once('main.php');
include('../../login/database/databaseconfig.php');
include('../backend/retrive.php');
$dbname = "logbook";
$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS company (
    company_id INT AUTO_INCREMENT PRIMARY KEY, 
    company_name VARCHAR(255) NOT NULL, 
    location VARCHAR(255) NOT NULL, 
    supervisor_id INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    //echo "Table 'company' created successfully or already exists.";
} else {
    //echo "Error in creating table company: " . $conn->error;
}
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

$sql = "SELECT * FROM company WHERE supervisor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // while ($row = $result->fetch_assoc()) {
        //    // echo "Company Id: " . $row["company_id"] . "<br>";
        //    // echo "Company name: " . $row["company_name"] . "<br>";
        //     echo "Location: " . $row["location"] . "<br>";
        //     echo "Supervisor: " . $row["supervisor_id"] . "<br>";
        // }
    } else {
        $row["company_name"]="unset";
        $row["location"] ="unset";
    }

echo '<section class="content">
<div class="show_header">
    <h1>COMPANY</h1>
</div>
<div style="padding-left:10px;">
    <div>
        <h1 style="text-align:center;">COMPANY INFORMATION</h1><br><br>
        <h4 style="text-align:center;"><b>This document contains the company information and the students having attachment in this company </b></h4><br><hr>
    </div>
    <form class="company_form" action="../backend/company.php" method="POST">
        <div>
        <br>
            <label for="company_name" class="companynamelabel"> Name : </label>
            <input type="text" name="company_name" id="company_name" class="company_name" value = '. $row["company_name"].' />
        </div>
        <div>
        <br>
            <label for="company_location">Location :</label>
            <input type="text" name="company_location" id = "company_location" class="company_location" name="company_location" value='.$row["location"].' />
        </div>
        <button style="background-color:rgb(17, 155, 155); padding:5px 10px; border-radius:20px; cursor:pointer; margin-top:10px;">UPDATE</button>
    </form>
    <div>
        <h1 style="text-align:center;">Student assigned to the company</h1>
        <table style="border-collapse:collapse; width:100%;" border="1">
            <thead>
            <tr>
                <th>student reg_number</th>
                <th>Student name</th>
                <th>Student_course</th>
                <th>starting date</th>
                <th>Duration</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                '.$display.'
            </tr>
            <form method="post" action="../backend/addstudent.php">
            <tr><td colspan="5" style="background-color:rgb(17, 155, 155); text-align:center; font-weight:medium; padding:5px 0px;">Enter new record</td></tr>
            <tr>
                <td colspan="3"><input type="text" placeholder="Enter admission number" name="regnumber" style="width:100%; height: 100%;"></td>
                <td><input type="date" name="date" style="width:100%; height:100%;"></td>
                <td><input type="number" name="duration"><button type= "submit"style="background-color:rgb(17, 155, 155); padding:5px 10px; border-radius:20px; cursor:pointer; margin-top:10px;">Add new record</button></td>
            </tr>
            </form>
            </tbody>
        </table>
    </div>
</div>
</section>
';
include('footer.php');