<!DOCTYPE html>
<?php
    include("controller/functions.php");
    include("controller/SessionController.php");

    if( !isset($_SESSION )){
		session_start();
	}

    
    if(isset($_GET['product_id'])){
        cart();
    }
?>
<html>
<head>
    <title>Dream Denim</title>
    <link rel="stylesheet" href="res/styles/styles.css" media="all"/>
</head>
<!--Body starts here-->
<body class="main_wrapper">
    <!--Header starts here-->
    <div class="header_wrapper">
        <img id="logo" src="res/images/logo.gif" width="150" height="80" />
        <div id="login_message">
            <strong>Welcome, </strong>
            <?php
                if(isCredentialSaved()){
                    echo("<b>{$_SESSION['username']}</b>
                        <a href='controller/logout.php'><button id='button_hoverable'>Logout</button><a>
                        ");
                }
                else{
                    echo("<b>Guest</b>
                        <a href='view/login.php'><button id='button_hoverable'>Login</button><a>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="view/all_products.php">Products</a></li>
            <li><a href="view/view_profile.php">My Account</a></li>
            <li><a href="view/register.php">Sign Up</a></li>
            <li><a href="view/cart.php">Cart</a></li>
            <li><a href="view/contact.php">Contact Us</a></li>
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
            <?php getProducts(); ?>
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