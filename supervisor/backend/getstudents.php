<?php
include('../../login/database/databaseconfig.php');
$dbname = "logbook";
$st_information="";
$conn->select_db($dbname);
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT u.first_name, l.date, u.last_name, c.company_name, l.work_done, l.new_skills, l.supervisor_score, l.assessment,l.assessment_score ,l.logbook_id
            FROM log_books l
            INNER JOIN users u ON l.student_id = u.id
            INNER JOIN attachment a ON l.student_id = a.student_id
            INNER JOIN company c ON a.company_id = c.company_id
            WHERE c.supervisor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $st_information .=' <tr>
            <td>' . htmlspecialchars($row["date"]) . '</td>
            <td>'.$row["first_name"].' '.$row["last_name"].'</td>
            <td>' . htmlspecialchars($row["work_done"]) . '</td>
            <td>' . htmlspecialchars($row["new_skills"]) . '</td>
            <form method="post" action= "../backend/updatecomment.php">
            <td><input style="height:50px; width:100%;" type="text" name="supervisor_score" value="' . htmlspecialchars($row["supervisor_score"]) . '"</td>
            <td><input style="height:50px; width:100%;" type="text" value="'. htmlspecialchars($row["assessment"]) . '" name="comment" ></td>
            <td>' . htmlspecialchars($row["assessment_score"]) . '</td>
            <input type="number" value="'.$row["logbook_id"].'" name="logbook_id" style="display:none;"/>
            <td><button type="submit" class="submit" style="margin-left:0px;">submit</button></td>
            </form>
           
             </tr>';
        }
    } else {
        $st_information .=' <tr>
            <td>none</td>
            <td>none</td>
            <td>none</td>
            <td>none</td>
            <td>none</td>
            <td>none</td>
            <td>none</td>
             </tr>';
    }
    $stmt->close();