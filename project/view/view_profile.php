<!DOCTYPE html>
<?php
    include("../controller/functions.php");
    include("../controller/SessionController.php");
    

    if( !isCredentialSaved()){
		header("Location: login.php");
	}
    
    $fname = "";
	$lname = "";
	$email = "";
	$phone = "";
    $shipping = "";
    $billing = "";
    $id = "";

    $username = $_SESSION['username'];
    $query = "select * from user where user_username = '$username'";
    $user = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($user)){
        $id = $row['user_id'];
        $fname = $row['user_fname'];
        $lname = $row['user_lname'];
        $email = $row['user_email'];
        $phone = $row['user_phone'];
        $shipping = $row['Shipping_address'];
        $billing = $row['billing_address'];
    }
	
	if(isset($_POST['register'])){
        if(isset($_POST['fname'])){
            $fname = $_POST['fname'];
        }
        if(isset($_POST['lname'])){
            $lname = $_POST['lname'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
        }
        
        if(isset($_POST['billing'])){
            $billing = $_POST['billing'];
        }
        if(isset($_POST['shipping'])){
            $shipping = $_POST['shipping'];
        }
        

        if($fname != "" && $lname != "" && $email != "" && $phone != "" && $billing != "" && $shipping != ""){
            
            upUser($fname,$lname,$email,$phone,$billing,$shipping,$id);
            header("Location: view_profile.php");   
        }
        else{
            echo ("<script>alert('Please fill all the fields.')</script>");
        }
    }
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
        <form method="get" enctype="multipart/form-data" action="results.php">
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
            <form action="view_profile.php" method="POST" id="registration">
                <table>
                    <caption>Register here</caption>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="fname" value="<?= $fname;?>"/></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="lname" value="<?= $lname;?>"/></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?= $email;?>"/></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" value="<?= $phone;?>"/></td>
                    </tr>
                    
                    <tr>
                        <td>Billling Address</td>
                        <td><textarea name="billing"><?= $billing;?></textarea></td>
                    </tr>
                    <tr>
                        <td>Shipping Address</td>
                        <td><textarea name="shipping"><?= $shipping;?></textarea></td>
                    </tr>
                    
                    <tr>
                        <td rowspan="2" colspan="2"><input id='button_hoverable' type="submit" value="Update" name="register"/></td>
                    </tr>
                </table>
            </form>
        </div>
        <!--Content ends here-->
    </div>
    <!--Content area ends here-->
    
    <!--Footer starts here-->
    <div id="footer">
        <h3>WEB TECH PROJECT</h3>
    </div>
    <!--Footer ends here-->
    
</body>
<!--Body ends here-->
</html>