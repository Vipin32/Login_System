<?php

if(isset($_POST['login']))
{
  $username = sanitizeUsername($_POST['loginUsername']);
  $password = sanitizePassword($_POST['loginPassword']);

  $result = $obj->login($username,$password);

  if($result)
  {
    $_SESSION['loggedInUser'] = $username;
    header("Location: index.php?success=LoginSuccessfull");
  }
}


?>
