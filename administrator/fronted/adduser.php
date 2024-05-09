<?php 
    include('main.php');
    echo '<section class="content" >
        <div class="show_header">
            <h1>Lecture attachment assignment</h1>
        </div>
        <div style="padding-left:10px;">
            <div>
                <h1 style="text-align:center;">Lecture assignment</h1><br><br>
                <h3 style="text-align:center;">the information contained here should be accurate and true since the information given will enable the supervisor to access your work</h3><br>
                <h4 style="text-align:center;"><b>provide the username of the supervisor and the company name accurattely</b></h4><br><hr>
            </div>
            <div class="adduser">
                <div>
                <form action="../backend/user.php" method="POST" class="registration-form">
                <table>
                <tr>
                    <td><label for="email">Enter the email address : </label></td>
                    <td><input type="email" name="email" placeholder="Email" required /></td>
                </tr>
                <tr>
                    <td><label for="password">Enter the password :</label></td>
                    <td><input type="password" name="password" placeholder="Password" required /></td>
                </tr>
                <tr>
                    <td>
                        <label for="first_name">First_name:</label></td>
                       <td><input type="text" id="first_name" name="first_name" placeholder="first_name" /></td>
                    
                    <tr>
                    <td> <label for="sur_name">sur_name:</label></td>
                    <td> <input type="text" id="last_name" name="last_name" placeholder="sur_name" /></td>
                    </tr>
                </tr>
              <tr class="input_field radio_option">
              <td><label>Gender :</label></td>
                <td><input type="radio" name="gender" id="rd1" value="male">
                    <label for="rd1">Male</label>
                <input type="radio" name="gender" id="rd2" value="female">
                <label for="rd2">Female</label> 
                <input type="radio" name="gender" id="rd3" value="others">
                <label for="rd3">Others</label> 
                </td>
            </tr>
            <tr class="input_field select_option">
            <td><label for="register">Login_type</label></td>
              <td><select name="type" id="register">
                <option value="student" selected>STUDENT</option>
                <option value="lecturer">Lecture</option>
                <option value="supervisor">SUPERVISOR</option>
                <option value="admin">ADMIN</option>
              </select></td>
              </tr>
        <tr><td><input type="submit" value="click to register" style="background:green; padding:5px 20px; margin:5px;"></td></tr>
        </table>
      </form>
            ';