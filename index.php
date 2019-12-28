<?php include("include/config.php"); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <?php
    if(isset($_SESSION['loggedInUser'])){
      $user =  $_SESSION['loggedInUser'];
    }

  ?>
  <body>
    <div id="background">

        <div id="navbar">
          <ul>
            <?php
              if(isset($_SESSION['loggedInUser'])){
                echo '<li><a href="logout.php">Logout</a></li>';
              }
              else {
                echo '<li><a href="register.php">Login</a></li>';
              }
             ?>

            <li><a href="register.php?id=register">Register</a></li>
          </ul>
        </div>

        <div id="welcomeText">
          <h2>Welcome <?php echo $user; ?></h2>
          <p><span>Congratulations!</span> <br>You Have Logged In successfully.</p>
        </div>

    </div>
  </body>
</html>
