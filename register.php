<?php include('include/config.php'); ?>
<?php include('include/classes/Account.php');?>
<?php include('include/classes/Constants.php');?>

<?php
$obj = new Account($dbc);
?>
<?php include('include/handlers/register_handlers.php'); ?>
<?php include('include/handlers/login_handlers.php'); ?>


<!DOCTYPE HTML>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <title>Login System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
  </head>

  <?php
    function stickyForm($data)
    {
      if(isset($_POST[$data]))
      {
        echo $_POST[$data];
      }
    }
   ?>

   <!-- Show RegisterForm and hide LoginForm When Register button is clicked -->
   <?php
    if(isset($_POST['register']))
    {
      echo '<script>
        $(document).ready(function(){
          $("#registerForm").show();
          $("#loginForm").hide();
        });
      </script>  ';
    }
    else{
      echo '<script>
        $(document).ready(function(){
          $("#registerForm").hide();
          $("#loginForm").show();
        });
      </script>  ';
    }
    ?>

    <?php
      if(isset($_GET['id'])){
          $page = $_GET['id'];
          if($page == 'register')
          {
            echo '<script>
              $(document).ready(function(){
                $("#registerForm").show();
                $("#loginForm").hide();
              });
            </script>  ';
          }
          else {
            echo '<script>
              $(document).ready(function(){
                $("#registerForm").hide();
                $("#loginForm").show();
              });
            </script>  ';
          }
      }

     ?>
  <body>
    <div id="background">

      <div id="navbar">
        <ul>
          <?php
            if(isset($_SESSION['loggedInUser'])){
              echo '<li><a href="logout.php">Logout</a></li>';
              echo '<li><a href="index.php">Go To Home Page</a></li>';
            }
            else {
              echo '<li><a href="register.php?id=register">Register</a></li>';
              echo '<li><a href="register.php?id=login">Login</a></li>';
            }
           ?>
        </ul>
      </div>

      <div id="loginContainer">
          <div id="inputContainer">

            <!-- Login Form -->
            <form id="loginForm" action="register.php" method="POST">
              <h2>Login Form</h2>
              <p class="form-group">
                <label for="username">Username</label>
                <input type="text" name="loginUsername" id="username" value="<?php stickyForm('username'); ?>" placeholder="Enter Username">
              </p>

              <p class="form-group"></label>
                <label for="password">Password</label>
                <input type="password" name="loginPassword" id="password" value="<?php stickyForm('password'); ?>" placeholder="Enter your password">
              </p>

              <p>
                <?php echo $obj->printError(Constants::$loginFailed); ?>
              </p>

              <input type="submit" name="login" value="Login">

              <div class="hasAccountText">
                <span id="hideLogin">Don't Have an Account yet? Register Here!</span>
              </div>
            </form>
            <!-- Login Form -->

            <!-- Register Form Starts -->
              <form id="registerForm" action="register.php" method="POST">
                  <h2>Register Form</h2>
                  <p class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?php stickyForm('username'); ?>" placeholder="Enter Username">
                    <span class="error"><?php echo $obj->printError(Constants::$usernameLength); ?></span>
                    <span class="error"><?php echo $obj->printError(Constants::$usernameTaken); ?></span>
                  </p>

                  <p class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" value="<?php stickyForm('firstname'); ?>" placeholder="Enter First Name">
                    <span class="error"><?php echo $obj->printError(Constants::$firstNameLength); ?></span>

                  </p>

                  <p class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" value="<?php stickyForm('lastname'); ?>" placeholder="Enter Last Name">
                    <span class="error"><?php echo $obj->printError(Constants::$lastNameLength); ?></span>
                  </p>

                  <p class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php stickyForm('email'); ?>" placeholder="Enter Email">
                    <span class="error"><?php echo $obj->printError(Constants::$invalidEmail); ?></span>
                    <span class="error"><?php echo $obj->printError(Constants::$emailTaken); ?></span>
                  </p>

                  <p class="form-group">
                    <label for="confirmemail">Confirm Email</label>
                    <input type="email" name="confirmemail" value="<?php stickyForm('confirmemail'); ?>" placeholder="Confirm your Email">
                    <span class="error"><?php echo $obj->printError(Constants::$emailNotMatched); ?></span>
                  </p>

                  <p class="form-group"></label>
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php stickyForm('password'); ?>" placeholder="Enter Password">
                    <span class="error"><?php echo $obj->printError(Constants::$passwordLength); ?></span>
                    <span class="error"><?php echo $obj->printError(Constants::$passwordCharacters); ?></span>
                  </p>

                  <p class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" name="confirmpassword" placeholder="Confirm your password">
                    <span class="error"><?php echo $obj->printError(Constants::$passwordNotMatched); ?></span>
                  </p>

                  <input type="submit" name="register" value="Register">

                  <div class="hasAccountText">
                    <span id="hideRegister">Already Have an Account yet? Login Here!</span>
                  </div>
              </form>
              <!-- Register Form Ends -->
          </div>
          <!-- inputContainer Ends Here -->

          <div id="right_section">
              <h2>Get Great Movies, Right Here</h2>
              <h3>Download or Watch Your Favourite Movies For Free! </h3>
              <ul>
                <li>Login To Go To HomePage</li>
                <li>Sign Up for free</li>
                <li>Create your account to get movie updates.</li>
                <li>Request your favourite movie.</li>
              </ul>
          </div>
      </div>
    </div>

    <footer>
      <div id="footer">
        <p>Designed By Vipin Kumar</p>
        <p>Copyright &copy; 2016-2019</p>
      </div>
    </footer>
  </body>
</html>
