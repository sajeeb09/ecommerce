<?php
    
    include("../controller/db.php");

    $deleted = false;

    if($_GET['brand_id']){
        
        $id = $_GET['brand_id'];
        
        $query = "delete from brands where brand_id = '$id'";
            
        $deleted = mysqli_query($connection, $query);
        
        if($deleted){
            echo("<script>alert('Brand deleted');</script>]");
            header("Location: ../index.php?view_brands");
        }
    }
?>