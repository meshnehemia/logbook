<?php 
include_once('main.php');

echo '<section class="content">
        <div class="show_header">
            <h1>PROFILE</h1>
        </div>
        <div>
        <br>
        <br>
            <div><h1 style="text-align:center;">CHUKA UNIVERSITY ATTACHMENT PORTAL</h1></div><br>
            <div><h1 style="text-align:center;">Lecture information</h1></div>
          <br><hr>
        </div>
        <div style="display:flex; padding:20px;">
        <br>
            <div>
                <img src="https://th.bing.com/th/id/OIP.m27ACg2doJTj-XEXy_vhFwHaFj?rs=1&pid=ImgDetMain" width="300" height="200" />
            </div>
            <div style="padding:20px; font-size: 18px; font-weight:bold;">
                <form>
                <br>
                <div><span>first name : ' .$_SESSION['user_fname'].'</span>&nbsp; <br><br><span>last name : '. $_SESSION['user_lname'].'</span>
                    </div>
                    <br>
                    <div>Email : '.$_SESSION['user_email'].'</div>
                    <br>
                    </form>
            </div>
        </div>
        </section>';