<?php

function sanitizeForm($data)
{
  $data = strip_tags($data);
  $data = str_replace(" ", "", $data);
  $data = ucfirst(strtolower($data));
  return $data;
}

function sanitizeUsername($data)
{
  $data = strip_tags($data);
  $data = str_replace(" ", "", $data);
  return $data;
}

function sanitizePassword($data)
{
  $data = strip_tags($data);
  return $data;
}




  if(isset($_POST['register']))
  {
        $username = sanitizeUsername($_POST['username']);
        $firstname = sanitizeForm($_POST['firstname']);
        $lastname = sanitizeForm($_POST['lastname']);
        $email = sanitizeUsername($_POST['email']);
        $confirmemail = sanitizeUsername($_POST['confirmemail']);
        $password = sanitizePassword($_POST['password']);
        $confirmpassword = sanitizePassword($_POST['confirmpassword']);

        $result = $obj->register($username, $firstname, $lastname, $email, $confirmemail, $password, $confirmpassword);

        if($result)
        {
          header("Location: register.php?success=registration successfully");
        }

  }

?>
