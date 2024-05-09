<?php 
    session_start();
    include_once('main.php');
    include('../../login/database/databaseconfig.php');
    $dbname = "logbook";
    $conn->select_db($dbname);
    $sql = "SELECT * FROM log_books where student_id = {$_SESSION['user_id']} ORDER BY date DESC";
    $result = $conn->query($sql);
    $logbooks="";
   
        include_once('main.php');
        echo'<section class="content">
                <div class="show_header">
                    <h1>LOGBOOK</h1>
                </div>
                <div class="student_assessment" style="text-align:center;">
                    <h1>chuka university student logbooks</h1>
                    <h3>Below is the student activities</h3>
                    <br><br>
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
