<?php
    
    include("../controller/db.php");

    $deleted = false;

    if($_GET['cat_id']){
        
        $id = $_GET['cat_id'];
        
        $query = "delete from categories where cat_id = '$id'";
            
        $deleted = mysqli_query($connection, $query);
        
        if($deleted){
            echo("<script>alert('Category deleted');</script>]");
            header("Location: ../index.php?view_cats");
        }
    }
?>