<?php

$hostname = "localhost";
$username = "root";
$pwd = "84jJv0Xc5xT0";
$dbname = "chatapp";

$conn = mysqli_connect($hostname,$username,$pwd,$dbname);
if(!$conn){
    header("location:../index.php?error=sql-connection-failed");
    exit();
}
