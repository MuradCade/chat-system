<?php
include("../model/dbcon.php");
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
  // include("../controller/register.class.php");
  $id = $_SESSION['id'];
    $sql = "update  users  set status= 'online now' where unique_id = '$id'";
    $result =  mysqli_query($conn,$sql);

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    <title>Dashboard</title>
</head>
<body>
<body>

  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
             <?php include('display.php');?>
          <a href="../includes/logout.php?id=<?php echo $_SESSION['id']?>"class="logout">Logout</a>
        </div>
      </header>

      <div class="users-list">
      <?php 
      $user_id = $_SESSION['id'];
      $sql = "select * from users where unique_id!='$user_id'";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
        
        echo '<img src="../img/add-user.png" alt="profile-pic" class="profile">';
        echo "<a class='new-users' href='chat.php?id=".$row['unique_id']."' class='names'><span>".$row['fname']. " ".$row['lname']."</span></a>";
        echo "<br>";
            
        
              
    
                  
      }
       ?>
      </div>
    </section>
  </div>
  <script src="main.js"></script>
</body>
</html>

<?php 
    
}
else{
    header("location:../index.php");
    exit();
}
?>