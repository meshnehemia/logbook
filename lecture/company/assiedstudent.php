<?php
include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT u.first_name, u.last_name, s.admin_no, s.course_name,  s.student_id
                FROM lecstudent ls
                INNER JOIN student s ON ls.student_id = s.student_id
                INNER JOIN users u ON s.student_id = u.id
                WHERE ls.lecturer_id= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
$show_students ="";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $show_students .='<tr><td>'.$row["first_name"].' '.$row["last_name"] .'</td>
            <td>'.$row["admin_no"] .'</td>
            <td>'. $row["course_name"] .'</td>
            <td><form method="post" action="assess.php">
                        <input type="number" value="'.$row["student_id"].'" name="stid" style="display:none;"/>
                        <button type="submit" class="assessment">asses the student</button>
                        </form></td>
            </tr>';

        }
    } else {
       // echo "0 results";
    }
    $stmt->close();
