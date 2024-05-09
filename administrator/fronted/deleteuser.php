<?php 
    include('main.php');
    include('../backend/allusers.php');
    echo '<section class="content">
    <div class="show_header">
    <h1>Lecture attachment assignment</h1>
    </div>
    <div style="padding-left:10px;">
    <div>
        <h1 style="text-align:center;">Lecture assignment</h1><br><br>
        <h3 style="text-align:center;">the information contained here should be accurate and true since the information given will enable the supervisor to access your work</h3><br>
        <h4 style="text-align:center;"><b>provide the username of the supervisor and the company name accurattely</b></h4><br><hr>
    </div>
        <table style="width:100%; border-collapse:collapse;margin-top:20px; overflow-y:scroll;" border="1">
            <thead>
                <tr>
                    <th>name</th>
                    <th>id</th>
                    <th>type</th>
                    <th>remove</th>
                </tr>
                <tbody>
                    '.$display.'
                </tbody>
            </thead>
        </table>
    ';
    include('footer.php');