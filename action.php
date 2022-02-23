<?php
include("../model/dbcon.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    
    if(empty($email)){
        header("Location:../index.php?error=empty-username-field");
        exit();
    }
    else if(empty($pwd)) {
        header("Location:../index.php?error=empty-password-field");
        exit();
    }
    else{
     
     
    //    getting rid off spaces
        $email = str_replace(' ','',$email);        
       //    replace html gat in input feild            
        $email = str_replace("<","&lt;",$email);


         //hashing password in registration form usid md5 example provided below
         // $pwdhash = md5($pwd);
 
         //created a sql template
         $sql = "SELECT * FROM users where email = ? and password = ?;";
          
         //create prepared statement
         $stmt = mysqli_stmt_init($conn);
 
         // prepare the prepared statement 
         if(!mysqli_stmt_prepare($stmt,$sql)){
             header("location:../index.php?errors=sql-statement-failed");
             exit();
         } else {
             //bind the parameters to the placeholder
             //means replace ?? to the actual data that we gets from the user
             //param stands for parameter
             mysqli_stmt_bind_param($stmt , "ss",$email,$pwd);
             //run parameters inside database
             mysqli_stmt_execute($stmt);
            
             $result = mysqli_stmt_get_result($stmt);
 
             if(mysqli_num_rows($result) === 1){
                 $row = mysqli_fetch_assoc($result);
                 if($row['email'] == $email && $row['password'] == $pwd){
                     session_start();
                     $_SESSION['id'] = $row['unique_id'];
                     $_SESSION['username'] = $row['email'];
                     $_SESSION['fname'] = $row['fname'];
                    //  $_SESSION['role'] = $row['type'];
                     header("location:../view/home.php");
                     die();
 
                 }
                 else{
                     header("Location:../index.php?error=incorrect-username-and-password");
                     exit();
                 }
 
             }   else{
                 header("Location:../index.php?error=incorrect-username-and-password");
                 exit();
              
             }
 
         }

      
    }
}

