<?php
require '../includes/header.php';
require '../includes/connect.php';


$_SESSION = [];

session_destroy();

header("Location:".APPURL.""); 
exit();
?>
