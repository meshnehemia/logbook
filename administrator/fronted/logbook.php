<?php 
    session_start();
    include_once('main.php');
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);
    $sql = "SELECT * FROM log_books ORDER BY date DESC";
    $result = $conn->query($sql);
    $logbooks="";
    
        include_once('main.php');
        echo'<section class="content">
                <div class="show_header">
                    <h1>LOGBOOK</h1>
                </div>
                <div class="student_assessment">
                    <h1>chuka university lecture evaluation portal</h1>
                    <h3>Below are the students assigned </h3>
                </div>
                <div>
                    <table style="width:100%; border-collapse:collapse;" border=1>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>work done</th>
                                <th>new skills</th>
                                <th>Industry assesment score</th>
                                <th>supervisor comment review</th>
                                <th>lecture assessment comment</th>
                            </tr>
                        </thead>
                        <tbody>';
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                                $fname = "none";
                                $lname = "none";
                                $comp_name.= "none";
                                $sql2 = "SELECT first_name, last_name FROM users WHERE id = '" . $row['student_id'] . "'";
                                $sql3 = "SELECT *
                                FROM attachment AS att
                                INNER JOIN company AS c ON att.company_id = c.company_id
                                WHERE att.student_id = '" . $row['student_id'] . "'";
                                $rs1 = $conn->query($sql2);
                                $rs2 = $conn->query($sql3);

                                if ($rs1->num_rows > 0) {
                                    $r1 = $rs1->fetch_assoc();
                                    $fname = $r1['first_name'];
                                    $lname = $r1['last_name'];
                                }

                                if ($rs2->num_rows > 0) {
                                    $r2 = $rs2->fetch_assoc();
                                    $comp_name = $r2['company_name'];
                                }
                    $logbooks=$logbooks ."<tr>
                            <td>" . htmlspecialchars($row["date"]) . "</td>
                            <td>".$fname." ".$lname."</td>
                            <td>".$comp_name."</td>
                            <td>" . htmlspecialchars($row["work_done"]) . "</td>
                            <td>" . htmlspecialchars($row["new_skills"]) . "</td>
                            <td>" . htmlspecialchars($row["supervisor_score"]) . "</td>
                            <td>" . htmlspecialchars($row["assessment"]) . "</td>
                            <td>" . htmlspecialchars($row["assessment_score"]) . "</td>
                        </tr>";
    }
    $logbooks = $logbooks ."</tbody>
    </table>
</div>
</section>";
     echo $logbooks;
}

$conn->close();