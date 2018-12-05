<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
  <title>Calendar</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="Style/settingsstyle.css">
     <link rel="stylesheet" href="Style/fullCallendar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
 </head>
 <body>
 
 <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
 </form>

  <header>
    <div class="navBar">
<!-- Place holder for our logo -->
<div class="logo">
  <img src="Logo.png" alt="">
</div>
<!-- End of Logo  -->

<!-- navigation Bar -->
  <ul class="main-nav">
      <li><i class="fa fa-home"></i><a href="HomePage.html">Account</a></li>
      <li class="active"><i class="fa fa-unlock-alt"></i><a href="sSettingsPage.html" id="loginbtn">Settings</a></li>
      <li><i class="fa fa-unlock-alt"></i><a href="Php/Signout.php" id="loginbtn">Sign Out</a></li>
  </ul>
</div>

<!-- End of NavBar -->
  </header>
  <div class="container">
   <div id="calendar"></div>
  </div>
  <footer class="site-footer">

  <div class="copyright">
    <p>&copy All Rights Reserved 2018 Pawel Stencel</p>
  </div>

  <div class="socialIcons">
    <p>Find us on Social Media!</p>
    <ul>
      <li><i class="fa fa-facebook"></i></li>
      <li><i class="fa fa-twitter"></i></li>
      <li><i class="fa fa-instagram"></i></li>
      <li><i class="fa fa-google"></i></li>
      <li><i class="fa fa-whatsapp"></i></li>
    </ul>
  </div>
</footer>
 </body>
</html>