<?php
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$conn->select_db($dbname);


    $sql = "CREATE TABLE IF NOT EXISTS lecstudent (
        lecturer_id INT NOT NULL,
        student_id INT NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
      //  echo "Table assignment created successfully";
    } else {
       // echo "Error creating table assignment: " . $conn->error;
    }

// SQL query to fetch required information including lecturer's name
$sql = "SELECT u.id, u.first_name AS student_first_name, u.last_name AS student_last_name, s.admin_no, c.company_name, l.first_name AS lecturer_first_name, l.last_name AS lecturer_last_name ,s.student_id AS st_id,ls.lecturer_id
        FROM users u
        LEFT JOIN student s ON u.id = s.student_id
        LEFT JOIN attachment a ON s.student_id = a.student_id
        LEFT JOIN company c on a.company_id = c.company_id
        LEFT JOIN lecstudent ls ON s.student_id = ls.student_id
        LEFT JOIN users l ON ls.lecturer_id = l.id
        WHERE u.type = 'student'";

$result = $conn->query($sql);
$my_result ="";
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        if(strlen($row["admin_no"])<=0){
            $row["admin_no"]="register to proceed";
        }
        if(strlen($row["company_name"])<=0){
            $row["company_name"]="not assigned";
        }
        $my_result .='<tr><td>'. $row["student_first_name"].' '. $row["student_last_name"].'</td>
                    <td>'. $row["admin_no"].'</td>
                    <td>'. $row["company_name"].'</td>
                    <td><form method="POST" action="">
                        <input type ="number" name="student_id"value="'.$row['st_id'].'" style="display:none;" />
                        <input type="text" name="lecture_id" value="'.$row["lecturer_id"].'" style="background:transparent; width:100%;border:none;"/>
                        <button type="submit" class= "submit" style="margin-left:0;">update</button>
                    </form></tr>
                        ';
                    
    }
} else {
    //echo "0 results";
}
