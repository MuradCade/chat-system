<?php
include("../model/dbcon.php");
session_start();

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $sql = "update  users  set status= 'offline now' where unique_id = '$id'";
    $result =  mysqli_query($conn,$sql);
    if($result){
        session_unset();
        session_destroy();
        header("location:../index.php");
    }
    else{
        session_unset();
        session_destroy();
        header("location:../index.php");
    }


}
else{

    session_unset();
    session_destroy();
    header("location:../index.php");
    
}


