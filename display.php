<?php

include("../model/dbcon.php");

$user_id = $_SESSION['id'];
$sql = "select * from users where unique_id='$user_id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
//    echo"<img src='image/".echo $row['image'].'" alt=''>";
      
             echo '<img src="../img/add-user.png" alt="profile-pic" class="profile">';
             echo "<span class='names'>".$row['fname']. " ". $row['lname']."<span>";
            
            

}