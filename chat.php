<?php 
  session_start();
  include_once "../model/dbcon.php";
  if(!isset($_SESSION['id'])){
    header("location: login.php");
    exit();
  }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>

<script>
   function reload(time){
    setTimeout("location.reload(true);",time);

  }
</script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Chat</title>
</head>
<body onload="Javascript:reload(30000)">
    
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
      $user_id = $_GET['id'];
        $sql = "select * from users where  unique_id = '$user_id'";
        $result = mysqli_query($conn,$sql);
          
            ?>
        <?php 
          while($row = mysqli_fetch_assoc($result)){
  ?>
        <!-- <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
        <img src="../img/add-user.png" alt="profile-pic" class="profile">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
     <?php } ?>
      <div class="chat-box" id="chat-box">
      <div class="messages-container">
      <?php 
      

      if(isset($_SESSION['id'])){
          $outgoing_id = $_SESSION['id'];
          // echo $fname = $_SESSION['fname'];
          $incoming_id = $_GET['id'];
          $output = "";
          $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                  WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                  OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
          $query = mysqli_query($conn, $sql);
          if(mysqli_num_rows($query) > 0){
              while($row = mysqli_fetch_assoc($query)){
                  if($row['outgoing_msg_id'] == $outgoing_id){
                      $output .= '<div class="chat outgoing">
                                  <div class="details">
                                       <p class="m1">'.$row['msg'] .'</p>
                                  </div>
                                  </div>';
                  }else{
                      $output .= '<div class="chat incoming">
                                  <img src="../img/add-user.png" alt="profile-pic">
                                  <div class="details"> <p class="m2">'. $row['msg'] .'</p>
                                  </div>
                                  </div>';
                  }
              }
          }else{
              $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
          }
          echo $output;
      }else{
          header("location: ../login.php");
      }
        
        ?>
      </div>
      </div>
      <form action="insert_chat.php?id=<?php echo $user_id;?>" method="post" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
         <button>Send</button>
      </form>
    </section>
  </div>
<script src="jquery.js"></script>

</body>
</html>
