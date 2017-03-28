<!DOCTYPE> 
<?php
    include("controller/SessionController.php");

    if(!isCredentialSaved()){
        header("Location: view/login.php");
    }
    else if($_SESSION['password']!="admin"){
        header("Location: view/login.php");
    }
?>

<html>
	<head>
		<title>Admin Control Panel</title> 
		
	<link rel="stylesheet" href="res/styles/styles.css" media="all" /> 
	</head>


<body> 

	<div class="main_wrapper">
	
	
		<div id="header"></div>
		
		<div id="left">
		<h2 style="text-align:center;">Manage Content</h2>
			
			<a href="index.php?insert_product">Insert New Product</a>
			<a href="index.php?view_products">View All Products</a>
			<a href="index.php?insert_cat">Insert New Category</a>
			<a href="index.php?view_cats">View All Categories</a>
			<a href="index.php?insert_brand">Insert New Brand</a>
			<a href="index.php?view_brands">View All Brands</a>
			<a href="index.php?view_customers">View Customers</a>
			<a href="controller/logout.php">Admin Logout</a>
		
		</div>
		
		<div id="right">
		<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
		<?php
            
            
            if(isset($_GET['insert_product'])){

            include("view/insert_product.php"); 

            }
            if(isset($_GET['view_products'])){

            include("view/view_products.php"); 

            }
            if(isset($_GET['edit_pro'])){

            include("view/edit_product.php"); 

            }
            if(isset($_GET['insert_cat'])){

            include("view/insert_cat.php"); 

            }

            if(isset($_GET['view_cats'])){

            include("view/view_cats.php"); 

            }

            if(isset($_GET['edit_cat'])){

            include("view/edit_cat.php"); 

            }

            if(isset($_GET['insert_brand'])){

            include("view/insert_brand.php"); 

            }

            if(isset($_GET['view_brands'])){

            include("view/view_brands.php"); 

            }
            if(isset($_GET['edit_brand'])){

            include("view/edit_brand.php"); 

            }
            if(isset($_GET['view_customers'])){

            include("view/view_customers.php"); 

            }

            ?>
		</div>

	</div>

</body>
</html>