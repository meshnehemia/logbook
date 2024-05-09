<?php 
session_start();
include_once('main.php');
include('../../login/database/databaseconfig.php');
include('../company/companyinfo.php');
echo '<section class="content">
<div class="show_header">
    <h1>COMPANY</h1>
</div>
<div style="padding-left:10px;">
    <div>
        <h1 style="text-align:center;">ATTACHMENT PLACE</h1><br><br>
        <h4 style="text-align:center;"><b>this is the place assigned in your attachment please contact company supervisor to assign you to the task if its empty</b></h4><br><hr>
    </div>
    <form class="company_form" action="../company/companyinfo.php" method="POST">
        <div>
        <br>
            <label for="company_name" class="companynamelabel"> Name : '. htmlspecialchars($row['company_name']).'</label>
        </div>
        <div>
        <br>
            <label for="company_location">Location :  '.htmlspecialchars($row['location']).'</label>
        </div>
        <div>
        <br>
            <label for="company_supervisor">Supervisor name : '.htmlspecialchars( $row["first_name"]).' '.htmlspecialchars( $row["last_name"]).'</label>
        </div>
        <div><br>
            <label for ="duration">attachment duration Duration : '. htmlspecialchars($row['duration']) .'</label>
        </div>
        <div>
        <br>
            <label for="starting" >Starting date : '. htmlspecialchars($row['start_date']) .'</label>
        </div>
    </form>

</div>
<div style="margin-left:20px;">
<br><br>
    <p>I m eager to dive into this project and collaborate to achieve the best possible outcome. The attached document outlines the company s expectations, but I m also open to feedback and discussion."
    "Together with the company s guidance and the information provided in the attached document, I believe we can achieve great things. Let s work as a team!"
    "I m ready to follow the company s lead and contribute my best efforts. Feel free to reach out if you have any questions or suggestions. You ll find more details in the attached document."</p>
</div>


</section>';