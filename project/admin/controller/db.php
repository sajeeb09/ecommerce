<?php
    $connection = mysqli_connect("localhost","root","","denims");

    if(mysqli_connect_errno()){
        echo("Connection failed " . mysqli_connect_errno());
    }
?>