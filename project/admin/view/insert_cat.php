<!DOCTYPE html>
<?php
    include("../controller/functions.php");

	$category = "";
	
	$query = "";
	
	if(isset($_POST['insert_cat'])){

        if(isset($_POST['cat_title'])){
            $category = $_POST['cat_title'];
        }



        if($category != ""){
            
            $query = "insert into categories (cat_title) values ('$category')";
            
            $inserted = mysqli_query($connection, $query);
            
            
            if($inserted){
                echo("<script>alert('Successfully added $title')</script>");
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
    <title>Insert Product</title>
</head>
<body bgcolor="cyan">
    <form action="index.php?insert_cat" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Insert new category</h3></caption>
            
            
            <tr align="center">
                <td><b><b>Category Name:</b></b></td>
                <td>
                    <input type="text" name="cat_title"/>
                </td>
            </tr>
            
            
            <tr align="center">
                <td colspan="2"><input type=submit name="insert_cat" value="Insert"/></td>
            </tr>
        </table>
    </form>
</body>
</html>