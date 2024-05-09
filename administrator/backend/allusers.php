<?php 
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);
    $sql = "SELECT *FROM users";
    $result = $conn->query($sql);
    $display="";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $display .='<tr><td>'.$row["first_name"]." " . $row["last_name"].'</td>
            <td>'.$row['id'].'</td>
            <td>'.$row["type"].'</td>
            <td><button style="background:red; border-radius:20px; border:none; padding:5px 10px; cursor:pointer;" onclick="deleteStudentRecord('.$row["id"].')">Delete</button></td>
            </tr>';
        }
    } else {
        $display .='<td>no record</td>
            <td>no record</td>
            <td>no records</td>
            <td>none</td>';
    }
