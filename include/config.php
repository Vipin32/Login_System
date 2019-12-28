<?php
session_start();
ob_start();
$timezone = date_default_timezone_set("Asia/Kolkata");

$dbc = mysqli_connect('localhost','root','','login_system');

if(mysqli_errno($dbc))
{
    echo 'Failed To Connect '.mysqli_errno();
}

 ?>
