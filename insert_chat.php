<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "../model/dbcon.php";
        $outgoing_id = $_SESSION['id'];
       $id = $_GET['id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
        
        header("location:chat.php?id=$id");
        exit();
    }else{
        header("location: ../login.php");
    }


    
?>