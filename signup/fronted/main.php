<?php
include('header.php');

echo '
<div class="form_wrapper">
<div class="form_container">
  <div class="title_container">
    <h2>ELECTRONIC LOGBOOK SYSTEM </h2>
    <div class="feedback"></div>
  </div>
  <div class="row clearfix">
    <div class="">
      <form action="" method="POST" class="registration-form">
        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
          <input type="email" name="email" placeholder="Email" required />
        </div>
        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
          <input type="password" name="password2" placeholder="Re-type Password" required />
        </div>
        <div class="row clearfix">
          <div class="col_half">
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
              <input type="text" name="fname" placeholder="First Name" />
            </div>
          </div>
          <div class="col_half">
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
              <input type="text" name="lname" placeholder="Last Name" required />
            </div>
          </div>
        </div>
              <div class="input_field radio_option">
            <input type="radio" name="gender" id="rd1" value="male">
            <label for="rd1">Male</label>
            <input type="radio" name="gender" id="rd2" value="female">
            <label for="rd2">Female</label>
            </div>
            <div class="input_field select_option">
              <select name="register" id="register">
                <option value="student" selected>STUDENT</option>
                <option value="lecturer">Lecture</option>
                <option value="supervisor">SUPERVISOR</option>
              </select>
              <div class="select_arrow"></div>
            </div>
        <input type="submit" value="click to register" style="background:green; padding:5px 20px; margin:5px;">
        <a href="../../login/index.php" > click to login </a>
      </form>

    </div>
  </div>
</div>
</div>
<p class="credit">Developed by <a href="" target="_blank">MESHACK NEHEMIA @0757316903</a></p>';

require('footer.php');