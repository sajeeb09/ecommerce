<?php
    
    include("../controller/db.php");

    $deleted = false;

    if($_GET['pro_id']){
        
        $id = $_GET['pro_id'];
        
        $query = "delete from products where product_id = '$id'";
            
        $deleted = mysqli_query($connection, $query);
        
        if($deleted){
            echo("<script>alert('Product deleted');</script>]");
            header("Location: ../index.php?view_products");
        }
    }
?>