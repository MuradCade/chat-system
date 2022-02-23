<?php
include("../model/auto.php");

class display extends database{

    public function display_all_users($user_id,$data_type){
        $conn = $this->connection();
        $sql = "selec * from users where id != '$user_id'";
        $result = mysqli_query($conn,$sql);

        if($result){
            while($row = mysqli_fetch_assoc($result)){
                echo $row[$data_type];
            }
        }
        else{
            header("location:home.php?error=failed-to-fetch-data");
            exit();
        }
        return $row;
    }

}