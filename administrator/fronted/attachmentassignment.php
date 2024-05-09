<?php 
    include('main.php');
    include('../backend/lecassigned.php');
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_id = $_POST["student_id"];
            $lecturer_id = $_POST['lecture_id'];
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
                  //  echo "Lec_student record updated successfully";
                } else {
                  //  echo "Error updating lec_student record: " . $conn->error;
                }
                $stmt->close();
            } else {
                // Insert the new record
                $sql = "INSERT INTO lecstudent (lecturer_id, student_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $lecturer_id, $student_id);
                if ($stmt->execute()) {
                    //echo "New lec_student record created successfully";
                } else {
                   // echo "Error creating lec_student record: " . $conn->error;
                }
                $stmt->close();
            }
            $stmt_check->close();
        
    }


    echo '<section class="content">
<div class="show_header">
    <h1>Lecture attachment assignment</h1>
</div>
<div style="padding-left:10px;">
    <div>
        <h1 style="text-align:center;">Admin</h1><br><br>
        <h3 style="text-align:center;">the information contained here should be accurate and true since the information given will enable the supervisor to access your work</h3><br>
        <h4 style="text-align:center;"><b>provide the username of the supervisor and the company name accurattely</b></h4><br><hr>
    </div>
        <table style="width:100%; border-collapse:collapse" border="1">
            <thead>
                <tr>
                    <th>name</th>
                    <th>registration</th>
                    <th>company</th>
                    <th>lecture id</th>
                </tr>
                <tbody>
                    '.$my_result.'
                </tbody>
            </thead>
        </table>
    ';