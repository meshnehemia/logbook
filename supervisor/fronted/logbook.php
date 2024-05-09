<?php 
    session_start();
    include_once('main.php');
    include('../backend/getstudents.php');
        echo'<section class="content">
                <div class="show_header">
                    <h1>Student assessment</h1>
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
                            <th>work done</th>
                            <th>new skills</th>
                            <th>Industry assesment score</th>
                            <th>supervisor comment review</th>
                            <th>lecture assessment comment</th>
                            <th>submit</th>
                            </tr>
                        </thead>
                        <tbody>
                        '.$st_information.'
                        </tbody>
    </table>
</div>
</section>';
