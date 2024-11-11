<?php
// host
define("HOST","localhost");
// dbname
define("DBNAME","CoffeShop");
// username
define("USER","root");
// password
define("PASS","");
$conn=new PDO("mysql:host=".HOST.";dbname=".DBNAME."",  USER,PASS);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
if(!$conn){
die("connection failed");
}