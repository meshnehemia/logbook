<?php 
include_once('main.php');
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS student (
    student_id INT AUTO_INCREMENT PRIMARY KEY, 
    course_name VARCHAR(255) NOT NULL, 
    admin_no VARCHAR(255) NOT NULL
)";
$conn->query($sql);
$student_id = $_SESSION['user_id'];
$sql = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        ///echo "Student ID: " . $row["student_id"] . "<br>";
        //echo "Course Name: " . $row["course_name"] . "<br>";
        //echo "Admin No: " . $row["admin_no"] . "<br>";
    
} else {
    $row["student_id"]="not set";
    $row["course_name"] = "not set";
    $row["admin_no"] = "not set";
}
$stmt->close();
echo '<section class="content">
        <div class="show_header">
            <h1>PROFILE</h1>
        </div>
        <div>
        <br>
        <br>
            <div><h1 style="text-align:center;">CHUKA UNIVERSITY ATTACHMENT PORTAL</h1></div><br>
            <div><h1 style="text-align:center;">student information</h1></div>
          <br><hr>
        </div>
        <div style="display:flex; padding:20px;">
        <br>
            <div>
                <img src="https://th.bing.com/th/id/OIP.m27ACg2doJTj-XEXy_vhFwHaFj?rs=1&pid=ImgDetMain" width="300" height="200" />
            </div>
            <div style="padding:20px; font-size: 18px; font-weight:bold;">
                <br>
                <div><span>first name : ' .$_SESSION['user_fname'].'</span>&nbsp; <br><br><span>last name : '. $_SESSION['user_lname'].'</span>
                    </div>
                    <br>
                    <div>Email : '.$_SESSION['user_email'].'</div>
                    <br>
                    <form method="post" action="../company/student_info.php">
                    <div>course :  <input type="course" value="'.$row["course_name"].'" name="course_name" id ="course" style="background:transparent; border:none; font-weight:bold; font-size:medium;"/></div>
                    <br>
                    <div>Admission :  <input type="admission" value="'.$row["admin_no"].'" name="admin_no" id ="admission" style="background:transparent; border:none; font-weight:bold; font-size:medium;"/></div>
                    <input type="submit" value=" click to update course" style="cursor:pointer; background:green; padding:10px 20px; margin:10px; border-radius:20px; font-weight:bold; font-size:medium;">
                </form>
            </div>
        </div>
        
        </section>';