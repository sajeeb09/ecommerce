<!DOCTYPE html>
<?php
    include("../controller/functions.php");
    include("../controller/SessionController.php");

    $fname = "";
	$lname = "";
	$email = "";
	$phone = "";
	$username = "";
    $shipping = "";
    $billing = "";
	$pass1 = "";
	$pass2 = "";
	
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
        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if(isset($_POST['billing'])){
            $billing = $_POST['billing'];
        }
        if(isset($_POST['shipping'])){
            $shipping = $_POST['shipping'];
        }
        if(isset($_POST['pass1'])){
            $pass1 = $_POST['pass1'];
        }
        if(isset($_POST['pass2'])){
            $pass2 = $_POST['pass2'];
        }

        if($fname != "" && $lname != "" && $email != "" && $phone != "" && $username != "" && $billing != "" && $shipping != "" && $pass1 != "" && $pass2 != ""){
            if($pass1 == $pass2){
                saveUser($username,$fname,$lname,$email,$phone,$pass1);
                header("Location: login.php");
            }
            else{
                echo("<scrip>alert('Passwords do not match.')</script>");
            }
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
            <form action="register.php" method="POST" id="registration">
                <table>
                    <caption>Register here</caption>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="fname" /></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="lname" /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" /></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" /></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" /></td>
                    </tr>
                    <tr>
                        <td>Billling Address</td>
                        <td><textarea name="shipping"></textarea></td>
                    </tr>
                    <tr>
                        <td>Shipping Address</td>
                        <td><textarea name="billing"></textarea></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="pass1" /></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="pass2" /></td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="2"><input id='button_hoverable' type="submit" value="Register" name="register"/></td>
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