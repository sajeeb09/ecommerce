<!DOCTYPE html>
<?php
    include("../controller/functions.php");

	$brand = "";
	
	$query = "";

    $id = "";


    if(isset($_GET['edit_brand'])){
        
        $id = $_GET['edit_brand'];
        
        $query = "select * from brands where brand_id = $id";
        
        $get_brand = mysqli_query($connection, $query);
        
        while($run_brand = mysqli_fetch_array($get_brand)){
            $brand_name = $run_brand['brand_title'];
        }
        
        
    }


	
	if(isset($_POST['update_brand'])){

        if(isset($_POST['brand_title'])){
            $brand = $_POST['brand_title'];
        }



        if($brand != ""){
            
            $query = "update brands set brand_title = '$brand' where brand_id = $id";
            
            $updated = mysqli_query($connection, $query);
            
            
            if($updated){
                echo("<script>alert('Successfully updated $title')</script>");
                header("Location: index.php?view_brands");
            }
        }
        else{
            echo("<script>alert('Please fill all the fields.')</script>");
        }
    }
?>

<html>
<head>
    <title>Update Brand</title>
</head>
<body bgcolor="cyan">
    <form action="index.php?edit_brand=<?= $id?>" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Update Brand</h3></caption>
            
            
            <tr align="center">
                <td><b><b>Brand Name:</b></b></td>
                <td>
                    <input type="text" name="brand_title" value="<?= $brand_name?>"/>
                </td>
            </tr>
            
            
            <tr align="center">
                <td colspan="2"><input type=submit name="update_brand" value="Update"/></td>
            </tr>
        </table>
    </form>
</body>
</html>