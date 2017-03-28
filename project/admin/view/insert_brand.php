<!DOCTYPE html>
<?php
    include("../controller/functions.php");

	$brand = "";
	
	$query = "";
	
	if(isset($_POST['insert_brand'])){

        if(isset($_POST['brand_title'])){
            $brand = $_POST['brand_title'];
        }



        if($brand != ""){
            
            $query = "insert into brands (brand_title) values ('$brand')";
            
            $inserted = mysqli_query($connection, $query);
            
            
            if($inserted){
                echo("<script>alert('Successfully added $title')</script>");
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
    <title>Insert Product</title>
</head>
<body bgcolor="cyan">
    <form action="index.php?insert_brand" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Insert new Brand</h3></caption>
            
            
            <tr align="center">
                <td><b><b>Brand Name:</b></b></td>
                <td>
                    <input type="text" name="brand_title"/>
                </td>
            </tr>
            
            
            <tr align="center">
                <td colspan="2"><input type=submit name="insert_brand" value="Insert"/></td>
            </tr>
        </table>
    </form>
</body>
</html>