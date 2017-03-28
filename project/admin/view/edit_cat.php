<!DOCTYPE html>
<?php
    include("../controller/functions.php");

	$category = "";
	
	$query = "";

    $id = "";


    if(isset($_GET['edit_cat'])){
        
        $id = $_GET['edit_cat'];
        
        $query = "select * from categories where cat_id = $id";
        
        $get_cat = mysqli_query($connection, $query);
        
        $cat_name = mysqli_fetch_array($get_cat)['cat_title'];
    }


	
	if(isset($_POST['update_cat'])){

        if(isset($_POST['cat_title'])){
            $category = $_POST['cat_title'];
        }



        if($category != ""){
            
            $query = "update categories set cat_title = '$category' where cat_id = $id";
            
            $updated = mysqli_query($connection, $query);
            
            
            if($updated){
                echo("<script>alert('Successfully updated $title')</script>");
                header("Location: index.php?view_cats");
            }
        }
        else{
            echo("<script>alert('Please fill all the fields.')</script>");
        }
    }
?>

<html>
<head>
    <title>Update Category</title>
</head>
<body bgcolor="cyan">
    <form action="index.php?edit_cat=<?= $id?>" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Update category</h3></caption>
            
            
            <tr align="center">
                <td><b><b>Category Name:</b></b></td>
                <td>
                    <input type="text" name="cat_title" value="<?= $cat_name?>"/>
                </td>
            </tr>
            
            
            <tr align="center">
                <td colspan="2"><input type=submit name="update_cat" value="Update"/></td>
            </tr>
        </table>
    </form>
</body>
</html>