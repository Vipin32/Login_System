<?php include("include/config.php"); ?>

<?php

session_destroy();
session_unset();

header("Location: register.php");
?>
