<?php

class Account
{
  private $errorArray;
  private $conn;

  public function __construct($dbc)
  {
    $this->conn = $dbc;
    $this->errorArray = array();
  }


//Login Query
public function login($username, $password)
{
  $query = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password')";
  $result = mysqli_query($this->conn,$query);

  if(mysqli_num_rows($result) == 1)
  {
    return true;
  }
  else
  {
      array_push($this->errorArray, Constants::$loginFailed);
      return false;
  }
}

//Validate And Register
  public function register($un,$fn,$ln,$ema,$cema,$pass,$cpass)
  {
    $this->validateUsername($un);
    $this->validateFirstname($fn);
    $this->validateLastname($ln);
    $this->validateEmail($ema, $cema);
    $this->validatePassword($pass, $cpass);

    if(empty($this->errorArray))
    {
      return $this->insertQuery($un,$fn,$ln,$ema,$pass);
    }
    else
    {
      return false;
    }
  }


//Insert Query
private function insertQuery($username, $firstname, $lastname, $email, $password)
{
    $query = "INSERT INTO users (username,firstName,lastName,email,password) VALUES ('$username','$firstname','$lastname','$email',SHA1('$password'))";
    $result = mysqli_query($this->conn, $query);

    return $result;
}

//Print error
public function printError($error)
{
  if(!in_array($error,$this->errorArray,))
  {
    $error = '';
  }
  else {
    return "<span class='error'>$error</span>";
  }
}

//Validation
    private function validateUsername($un)
    {
      if(strlen($un) > 25 || strlen($un) < 5)
      {
        array_push($this->errorArray, Constants::$usernameLength);
        return;
      }

      //TOdo:: check username already exists
      $checkUserExists = "SELECT * FROM users WHERE username = '$un'";
      $result = mysqli_query($this->conn, $checkUserExists);

      if(mysqli_num_rows($result) == 1)
      {
        array_push($this->errorArray, Constants::$usernameTaken);
        return;
      }
    }

    private function validateFirstname($fn)
    {
      if(strlen($fn) > 40 || strlen($fn) < 2)
      {
        array_push($this->errorArray, Constants::$firstNameLength);
        return;
      }
    }

    private function validateLastname($ln)
    {
      if(strlen($ln) > 40 || strlen($ln) < 2)
      {
        array_push($this->errorArray, Constants::$lastNameLength);
        return;
      }
    }

    private function validateEmail($ema1,$ema2)
    {
      if($ema1 != $ema2)
      {
        array_push($this->errorArray, Constants::$emailNotMatched);
        return;
      }

      if(!(filter_var($ema1,FILTER_VALIDATE_EMAIL)))
      {
        array_push($this->errorArray, Constants::$invalidEmail);
        return;
      }

      //ToDo :: Check If Email Exists Already
      $checkEmailExists = "SELECT * FROM users WHERE email = '$ema1'";
      $result = mysqli_query($this->conn, $checkEmailExists);

      if(mysqli_num_rows($result) == 1)
      {
        array_push($this->errorArray, Constants::$emailTaken);
        return;
      }
    }

    private function validatePassword($pass1,$pass2)
    {
      if (strlen($pass1) > 30 || strlen($pass1) < 5)
      {
          array_push($this->errorArray, Constants::$passwordLength);
          return;
      }

      if($pass1 != $pass2 )
      {
        array_push($this->errorArray, Constants::$passwordNotMatched);
        return;
      }

      if(preg_match('/[^a-zA-Z0-9]/',$pass1))
      {
        array_push($this->errorArray, Constants::$passwordCharacters);
        return;
      }
    }

}


 ?>
