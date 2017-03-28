<?php

    $connection = mysqli_connect("localhost","root","","denims");
    $query = "";

    if(mysqli_connect_errno()){
        echo("Connection failed " . mysqli_connect_error());
    }


    //get categories in index.php.
    function getCats($page){
        global $connection, $query;
        $query = "select * from categories";
        $result = mysqli_query($connection, $query);
        
        while($cats_row = mysqli_fetch_array($result)){
            $cat_id = $cats_row['cat_id'];
            $cat_title = $cats_row['cat_title'];
            
            if($page == "index.php")
                echo("<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>");
            else
                echo("<li><a href='../index.php?cat=$cat_id'>$cat_title</a></li>");
        }
        
        
        
    }
	

    //get brands in index.php
    function getBrands($page){
        global $connection, $query;
        $query = "select * from brands order by brand_title";
        $result = mysqli_query($connection, $query);
        
        while($brand_row = mysqli_fetch_array($result)){
            $brand_id = $brand_row['brand_id'];
            $brand_title = $brand_row['brand_title'];
            if($page == "index.php")
                echo("<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>");
            else
                echo("<li><a href='../index.php?brand=$brand_id'>$brand_title</a></li>");
        }
        
        
    }


    //get categories in insert_product.php.
    function getCatsList(){
        global $connection, $query;
        $query = "select * from categories";
        $result = mysqli_query($connection, $query);
        
        while($cats_row = mysqli_fetch_array($result)){
            $cat_id = $cats_row['cat_id'];
            $cat_title = $cats_row['cat_title'];
            echo("<option value='$cat_id'>$cat_title</option>");
        }
        
        
    }


    //get brands in insert_product.php
    function getBrandsList(){
        global $connection, $query;
        $query = "select * from brands order by brand_title";
        $result = mysqli_query($connection, $query);
        
        while($brand_row = mysqli_fetch_array($result)){
            $brand_id = $brand_row['brand_id'];
            $brand_title = $brand_row['brand_title'];
            echo("<option value='$brand_id'>$brand_title</option>");
        }
        
        
    }



    //get products in homepage.
    function getProducts(){
        global $connection, $query;
		
		$query = "select * from products order by RAND() LIMIT 0,4";
        
        if(isset($_GET['cat'])){
            $query = "select * from products where product_cat={$_GET['cat']}";
        }
        else if(isset($_GET['brand'])){
            $query = "select * from products where product_brand={$_GET['brand']}";
        }
        
        
		$products = mysqli_query($connection, $query);
		
		while($rows = mysqli_fetch_array($products)){
			$product_id = $rows['product_id'];
			$product_cat = $rows['product_cat'];
			$product_brand = $rows['product_brand'];
			$product_title = $rows['product_title'];
			$product_price = $rows['product_price'];
			$product_image = $rows['product_image'];
            
            echo("
				<div id='single_product'>
					<h3>$product_title</h3>
					<a href='view/details.php?product_id=$product_id'><img src='admin/res/images/products/$product_image' width='180' height='180'/></a>
                    <p><b>Tk. $product_price</b></p>
                    
                    <a href='index.php?product_id=$product_id'><button id='button_hoverable'>Add to cart</button></a>
				</div>
			");
            
		}
        
        
    }



    //Get all products in all product page.
    function getAllProducts(){
        global $connection, $query;
		
		$query = "select * from products";
        
		$products = mysqli_query($connection, $query);
		
		while($rows = mysqli_fetch_array($products)){
			$product_id = $rows['product_id'];
			$product_cat = $rows['product_cat'];
			$product_brand = $rows['product_brand'];
			$product_title = $rows['product_title'];
			$product_price = $rows['product_price'];
			$product_image = $rows['product_image'];
            
            echo("
				<div id='single_product'>
					<h3>$product_title</h3>
					<a href='details.php?product_id=$product_id'><img src='../admin/res/images/products/$product_image' width='180' height='180'/></a>
                    <p><b>Tk. $product_price</b></p>
                    <a href='../index.php?product_id=$product_id'><button id='button_hoverable'>Add to cart</button></a>
				</div>
			");
            
		}
        
        
    }



    //get a products details in details page.
    function getProductDetails($product_id){
        global $connection, $query;
		
		$query = "select * from products where product_id = $product_id";
		$products = mysqli_query($connection, $query);
		
		while($rows = mysqli_fetch_array($products)){
			$product_cat = $rows['product_cat'];
			$product_brand = $rows['product_brand'];
			$product_title = $rows['product_title'];
			$product_price = $rows['product_price'];
			$product_image = $rows['product_image'];
            $product_desc = $rows['product_desc'];
            $product_quantity = $rows['product_quantity'];
            
            $brand = "select brand_title from brands where brand_id = $product_brand";
            $get_brand = mysqli_query($connection, $brand);
            $brand_name = mysqli_fetch_array($get_brand)['brand_title'];
            
            echo("
				<div id='single_product'>
                    <h3>$brand_name</h3>
					<h3>$product_title</h3>
					<img src='../admin/res/images/products/$product_image' width='400' height='300'/>
				</div>
                
                <div id='product_details'>
                    <p><h4>Tk. $product_price</h4></p>
                    <p>$product_desc</p>
                    <a href='../index.php?product_id=$product_id'><button id='button_hoverable'>Add to cart</button></a>
                </div>
			");
            
		}
        
        
    }




    //Get search results in result page.
    function searchResults(){
        global $connection, $query;
		
		if(isset($_GET['search'])){
            $search_query = $_GET['user_query'];
            $query = "select * from products where product_tags like '%$search_query%' or product_title like '%$search_query%' or product_cat like '%$search_query%' or product_brand like '%$search_query%'";
        
            $products = mysqli_query($connection, $query);

            while($rows = mysqli_fetch_array($products)){
                $product_id = $rows['product_id'];
                $product_cat = $rows['product_cat'];
                $product_brand = $rows['product_brand'];
                $product_title = $rows['product_title'];
                $product_price = $rows['product_price'];
                $product_image = $rows['product_image'];

                echo("
                    <div id='single_product'>
                        <h3>$product_title</h3>
                        <a href='details.php?product_id=$product_id'><img src='../admin/res/images/products/$product_image' width='180' height='180'/></a>
                        <p><b>Tk. $product_price</b></p>
                        <a href='../index.php?product_id=$product_id'><button>Add to cart</button></a>
                    </div>
                ");

            }
            
            
        }
    }




    //Stores all user data to db.
    function saveUser($username,$fname,$lname,$email,$phone,$pass){
        global $connection, $query;
        
        $query = "insert into user (user_username, user_fname, user_lname, user_email, user_phone,      user_pass) values ('$username','$fname','$lname','$email','$phone','$pass')";
        
        mysqli_query($connection, $query);
        
        
    }


    //Updates user data to db.
    function upUser($fname,$lname,$email,$phone,$billing,$shipping,$id){
        global $connection, $query;
        
        $query = "update user set user_fname='$fname', user_lname='$lname', user_email='$email', user_phone='$phone', billing_address='$billing', shipping_address='$shipping' where user_id='$id'";
        
        mysqli_query($connection, $query);
        
        
    }


    function getIp() {

        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        }

        return $ip;

    }


    
    function cart(){
        
        if(isset($_GET['product_id'])){

            global $connection; 

            $ip = getIp();
            
            $qtt = 1;

            $pro_id = $_GET['product_id'];

            $check_pro = "select * from cart where ip='$ip' AND pro_id='$pro_id'";

            $run_check = mysqli_query($connection, $check_pro); 

            if(mysqli_num_rows($run_check)>0){

                echo "";

            }
            else {

                $insert_pro = "insert into cart (pro_id,quantity,ip) values ('$pro_id','$qtt','$ip')";

                $run_pro = mysqli_query($connection, $insert_pro); 

                header("Location: index.php");
            }
        }
    }
?>