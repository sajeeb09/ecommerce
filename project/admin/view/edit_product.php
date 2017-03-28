<!DOCTYPE html>
<?php
    include("../controller/functions.php");
    

	$title = "";
	$cat_id = "";
	$brand_id = "";
	$desc = "";
	$price = "";
	$quantity = "";
	$tags = "";
	$image = "";
	$image_tmp = "";
	$query = "";
    $id = "";


    if(isset($_GET['edit_pro'])){
        $id = $_GET['edit_pro'];
        $query = "select * from products where product_id=$id";
        $get_pro = mysqli_query($connection, $query);
        while($product = mysqli_fetch_array($get_pro)){
            $title = $product['product_title'];
            $cat_id = $product['product_cat'];
            $brand_id = $product['product_brand'];
            $desc = $product['product_desc'];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];
            $tags = $product['product_tags'];
            $image = $product['product_image'];
        }
    }


    $query_cat = "select * from categories where cat_id=$cat_id";
    $query_brand = "select * from brands where brand_id=$brand_id";

    $get_cat = mysqli_query($connection, $query_cat);
    $get_brand = mysqli_query($connection, $query_brand);

    $category = mysqli_fetch_array($get_cat)['cat_title'];
    $brand = mysqli_fetch_array($get_brand)['brand_title'];

	
	if(isset($_POST['update_product'])){
        
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

        if($image == ""){
            $image = $_FILES['product_image']['name'];
            $image_tmp = $_FILES['product_image']['tmp_name'];
        }

        if($title != "" && $category != "" && $category != "Select a category" && $brand != "" && $brand != "Select a brand" && $brand != "" && $desc != "" && $price != "" &&            $quantity != "" && $tags != "" && $image != ""){
            
            echo("update products set product_cat='$category', product_brand='$brand', product_title='$title', product_price='$price'', product_desc='$desc', product_image='$image', product_quantity='$quantity'', product_tags='$tags' where product_id='$id''");
            
            $query = "update products set product_cat='$category', product_brand='$brand', product_title='$title', product_price=$price, product_desc='$desc', product_image='$image', product_quantity=$quantity, product_tags='$tags' where product_id=$id";
            
            $updated = mysqli_query($connection, $query);
            
            echo("<script>alert('cat = $category, brand = $brand')</script>");
            
            if($image_tmp != ""){
                move_uploaded_file($image_tmp, "res/images/products/$image");
            }
            
            if($updated){
                echo("<script>alert('Successfully updated $title')</script>");
                header("Location: index.php?view_products");
            }
        }
        else{
            echo("<script>alert('Please fill all the fields.')</script>");
        }
    }
?>

<html>
<head>
    <title>Update</title>
</head>
<body bgcolor="cyan">
    <form action="index.php?edit_pro=<?= $id; ?>" method="post" enctype="multipart/form-data">
        <table align="center" border="2" bgcolor="white" width="500">
            <caption><h3>Update this product</h3></caption>
            
            <tr align="center">
                <td><b>Product Title:</b></td>
                <td><input type=text name="product_title" value="<?= $title?>"/></td>
            </tr>
            
            <tr align="center">
                <td><b><b>Product Category:</b></b></td>
                <td>
                    <select name="product_cat">
                        <option>select a Category</option>
                        <?php getCatsList();?>
                    </select>
                </td>
            </tr>
            
            <tr align="center">
                <td><b>Product Brand:</b></td>
                <td>
                    <select name="product_brand">
                        <option>select a brand</option>
                        <?php getBrandsList();?>
                    </select>
                </td>
            </tr>
            
            <tr align="center">
                <td><b>Product Description:</b></td>
                <td><textarea name="product_desc" col="10" row="10"><?= $desc?></textarea></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Price:</b></td>
                <td><input type=text name="product_price" value="<?= $price?>"/></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Image:</b></td>
                <td>
                    <input type=file name="product_image"/>
                    <img src="res/images/products/<?= $image?>" width="80" height="80"/>
                </td>
            </tr>
            
            <tr align="center">
                <td><b>Product Quantity:</b></td>
                <td><input type=text name="product_quantity" value="<?= $quantity?>"/></td>
            </tr>
            
            <tr align="center">
                <td><b>Product Tags:</b></td>
                <td><input type=text name="product_tags" value="<?= $tags?>"/></td>
            </tr>
            
            <tr align="center">
                <td colspan="2"><input type=submit name="update_product" value="Update"/></td>
            </tr>
        </table>
    </form>
</body>
</html>