<?php 
    include('main.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_fname']) || !isset($_SESSION['user_lname'])) {
        header('Location: ../../login/index.php');
        die();
    }
    include('../company/assiedstudent.php');
   echo '<section class="content">
        <div class="show_header">
            <h1>Assigned students</h1>
        </div>
        <div class="student_assessment">
            <h1>chuka university lecture evaluation portal</h1>
            <h3>Below are the students assigned </h3>
        </div>
        <div>
            <table style="width:100%; border-collapse:collapse;" border=1>
                <thead>
                    <tr>
                        <th>Student name</th>
                        <th>admission</th>
                        <th>course</th>
                        <th>assess</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       '.$show_students.'
                    </tr>
                </tbody>
            </table>
        </div>
    </section>';