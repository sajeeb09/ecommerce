<!DOCTYPE html>
<?php
    include("../controller/functions.php");


	$title = "";
	$category = "";
	$brand = "";
	$desc = "";
	$price = "";
	$quantity = "";
	$tags = "";
	$image = "";
	$image_tmp = "";
	$query = "";
	
	if(isset($_POST['insert_product'])){
        if(isset($_POST['product_title'])){
            $title = $_POST['product_title'];
        }

        if(isset($_POST['product_cat'])){
            $category = $_POST['product_cat'];
        }

        if(isset($_POST['product_brand'])){
            $brand = $_POST['product_brand'];
        }

        if(isset($_POST['product_desc'])){
            $desc = $_POST['product_desc'];
        }

        if(isset($_POST['product_price'])){
            $price = $_POST['product_price'];
        }

        if(isset($_POST['product_quantity'])){
            $quantity = $_POST['product_quantity'];
        }

        if(isset($_POST['product_tags'])){
            $tags = $_POST['product_tags'];
        }

        $image = $_FILES['product_image']['name'];
        $image_tmp = $_FILES['product_image']['tmp_name'];

        if($title != "" && $category != "" && $category != "Select a category" && $brand != "" && $brand != "Select a brand" && $desc != "" && $price != "" && $quantity != "" && $tags != "" && $image != ""){
            
            $query = "insert into products (product_cat, product_brand, product_title, product_desc, product_price, product_image, product_quantity, product_tags) values ('$category','$brand','$title','$desc','$price','$image','$quantity','$tags')";
            
            $inserted = mysqli_query($connection, $query);
            
            
            if($inserted){
                move_uploaded_file($image_tmp, "res/images/products/$image");
                echo("<script>alert('Successfully added $title')</script>");
                header("Location: index.php?insert_product");
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
    <form action="index.php?insert_product" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Insert new product</h3></caption>
            
            <tr align="center">
                <td><b>Product Title:</b></td>
                <td><input type=text name="product_title"/></td>
            </tr>
            
            <tr align="center">
                <td><b><b>Product Category:</b></b></td>
                <td>
                    <select name="product_cat">
                        <option>Select a category</option>
                        <?php getCatsList();?>
                    </select>
                </td>
            </tr>
            
            <tr align="center">
                <td><b>Product Brand:</b></td>
                <td>
                    <select name="product_brand">
                        <option>Select a brand</option>
                        <?php getBrandsList();?>
                    </select>
                </td>
            </tr>
            
            <tr align="center">
                <td><b>Product Description:</b></td>
                <td><textarea name="product_desc" col="10" row="10"></textarea></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Price:</b></td>
                <td><input type=text name="product_price"/></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Image:</b></td>
                <td><input type=file name="product_image"/></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Quantity:</b></td>
                <td><input type=text name="product_quantity"/></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Tags:</b></td>
                <td><input type=text name="product_tags"/></td>
            </tr>
            
            <tr align="center">
                <td colspan="2"><input type=submit name="insert_product" value="Insert"/></td>
            </tr>
        </table>
    </form>
</body>
</html>