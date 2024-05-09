<?php 
    session_start();
    include_once('main.php');
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);
    $sql = "SELECT * FROM log_books where student_id = {$_POST['stid']} ORDER BY date DESC";
    $result = $conn->query($sql);
    $logbooks="";
        echo'<section class="content">
                <div class="show_header">
                    <h1>ASSESS STUDENT</h1>
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
                            $logbooks=$logbooks ."<tr>
                            <td>" . htmlspecialchars($row["date"]) . "</td>
                            <td>" . htmlspecialchars($row["work_done"]) . "</td>
                            <td>" . htmlspecialchars($row["new_skills"]) . "</td>
                            <td>" . htmlspecialchars($row["supervisor_score"]) . "</td>
                            <td>" . htmlspecialchars($row["assessment"]) . "</td>
                            <td>" .htmlspecialchars($row["assessment_score"]) . '
                            <form method="POST" action="../company/updatecomment.php">
                            <input style="display:none;"type="number" name="logbook_id" value="'. htmlspecialchars($row["logbook_id"]) .'" >
                            <input type="text" value="'.htmlspecialchars($row["assessment_score"]) .'" style="height:150px; width:70%;" name="assessment_score" >
                            <input type="submit" class="submit" style="margin-left:-20px;"/>
                            </form>
                            </td>
                        </tr>';
    }
    $logbooks = $logbooks ."</tbody>
    </table>
</div>
</section>";
     echo $logbooks;
}
$conn->close();
