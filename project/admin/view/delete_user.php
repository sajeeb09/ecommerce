<?php
    
    include("../controller/db.php");

    $deleted = false;

    if($_GET['user_id']){
        
        $id = $_GET['user_id'];
        
        $query = "delete from user where user_id = '$id'";
            
        $deleted = mysqli_query($connection, $query);
        
        if($deleted){
            echo("<script>alert('User deleted');</script>]");
            header("Location: ../index.php?view_customers");
        }
    }
?>