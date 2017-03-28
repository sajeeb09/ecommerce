<!DOCTYPE html>
<?php
    include("../controller/functions.php");
    include("../controller/SessionController.php");
?>
<html>
<head>
    <title>Dream Denim</title>
    <link rel="stylesheet" href="../res/styles/styles.css" media="all"/>
</head>
<!--Body starts here-->
<body class="main_wrapper">
    <!--Header starts here-->
    <div class="header_wrapper">
        <img id="logo" src="../res/images/logo.gif" width="150" height="80" />
        <div id="login_message">
            <strong>Welcome, </strong>
            <?php
                if(isCredentialSaved()){
                    echo("<b>{$_SESSION['username']}</b>
                        <a href='../controller/logout.php'><button id='button_hoverable'>Logout</button><a>
                        ");
                }
                else{
                    echo("<b>Guest</b>
                        <a href='login.php'><button id='button_hoverable'>Login</button><a>
                        ");
                }
            ?>
        </div>
        
    </div>
    <!--Header ends here-->
    
    <div class="other_content">
    <!--Menubar starts here-->
    <div class="menubar">
        <ul id="menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="all_products.php">Products</a></li>
            <li><a href="view_profile.php">My Account</a></li>
            <li><a href="register.php">Sign Up</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
        
        <!--Search form starts here-->
        <div id="search_form">
        <form method="get" enctype="multipart/form-data" action="view/results.php">
                <input type="text" name="user_query" placeholder="Search here"/>
                <input id='button_hoverable' type="submit" name="search" value="Search"/> 
        </form>
        </div>
        <!--Search form ends here-->
    </div>
    
    <!--Menubar ends here-->
    
    <!--Content area starts here-->
    <div class="content_wrapper">
        
        <!--Sidebar starts here-->
        <div id="sidebar">
            <div id="sidebar_titles"> Categories</div>
            <ul id="cats">
                <?php getCats(basename($_SERVER['PHP_SELF'])); ?>
            </ul>
            <div id="sidebar_titles"> Brands</div>
            <ul id="cats">
                <?php getBrands(basename($_SERVER['PHP_SELF'])); ?>
            </ul>
        </div>
        <!--Sidebar ends here-->
        
        <!--Content starts here-->
        <div id="content_area">
			
            <div id="products_box">
				
			<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700">
					
					<tr align="center">
						<th>Remove</th>
						<th>Product(S)</th>
						<th>Quantity</th>
						<th>Total Price</th>
					</tr>
					
		<?php 
            $total = 0;
                    
            $quantity = 1;

            global $con; 

            $ip = getIp(); 

            $sel_price = "select * from cart where ip='$ip'";

            $run_price = mysqli_query($connection, $sel_price); 

            while($p_price=mysqli_fetch_array($run_price)){

                $pro_id = $p_price['pro_id'];
                $quantity = $p_price['quantity'];

                $pro_price = "select * from products where product_id='$pro_id'";

                $run_pro_price = mysqli_query($connection,$pro_price); 

                while ($pp_price = mysqli_fetch_array($run_pro_price)){

                    $product_price = array($pp_price['product_price']);

                    $product_title = $pp_price['product_title'];

                    $product_image = $pp_price['product_image']; 

                    $single_price = $pp_price['product_price'];

                    $values = array_sum($product_price); 

                    $total += $values; 

            ?>
					
            <tr align="center">
                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                <td><?php echo $product_title; ?><br>
                <img src="../admin/res/images/products/<?php echo $product_image;?>" width="60" height="60"/>
                </td>
                <td><input type="text" size="4" name="qty" value="<?php echo $quantity;?>"/></td>
                
                    <?php 
                        if(isset($_POST['update_cart'])){

                            $qty = $quantity;

                            $update_qty = "update cart set quantity='$qty' where pro_id='$pro_id'";

                            $run_qty = mysqli_query($connection, $update_qty);
                            
                            if($run_qty){
                                echo("<script>alert('Updated');</script>");
                            }

                            $quantity=$qty;

                            $total = $total*$qty;
                            
                            header("Location: cart.php");
                        }
                    ?>
						
						
				<td><?php echo "TK. " . $single_price; ?></td>
					</tr>
					
					
				<?php } } ?>
				
				<tr>
						<td colspan="4" align="right"><b>Sub Total:</b></td>
						<td><?php echo "Tk. " . $total;?></td>
					</tr>
					
					<tr align="center">
						<td colspan="2"><input id="button_hoverable" type="submit" name="update_cart" value="Update Cart"/></td>
						<td>
                            <input id="button_hoverable" type="submit" name="continue" value="Continue Shopping" />
                        </td>
						<td>
                            <input type="submit" id="button_hoverable" name="checkout" value="Checkout"/>
                        </td>
					</tr>
					
				</table> 
			
			</form>
			
<?php 
		
	function updatecart(){
		
		global $connection; 
		
		$ip = getIp();
            
        foreach($_POST['remove'] as $remove_id){

            $delete_product = "delete from cart where pro_id='$remove_id' AND ip='$ip'";

            $run_delete = mysqli_query($connection, $delete_product); 

            if($run_delete){

                 header("Location: cart.php");
            }
        }

        if(isset($_POST['continue'])){

          header("Location: ../index.php");

        }
        
        if(isset($_POST['checkout'])){

          header("Location: checkout.php");

        }
	
	}
	echo @$up_cart = updatecart();
	
	?>

				
            </div>
        </div>
        <!--Content ends here-->
    </div>
    <!--Content area ends here-->
    
    <!--Footer starts here-->
    <div id="footer">
        <h3>WEB TECH PROJECT</h3>
    </div>
    <!--Footer ends here-->
    </div>
    
</body>
<!--Body ends here-->
</html>