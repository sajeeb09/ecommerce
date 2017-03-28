<!DOCTYPE html>
<?php
    include("../controller/SessionController.php");

    $username = "";
	$password = "";
	
	if(isset($_POST['login'])){
        if($_POST['username']){
			$username = $_POST['username'];
		}
		if($_POST['pass']){
			$password = $_POST['pass'];
		}
		if($username != "" && $password != ""){
        
			if($username == "admin" && $password == "admin"){
				if(!verify($username, $password)){
					saveCredential($username, $password);
				}
                header("LOCATION: ../index.php");
			}
			
			if($username != "admin"){
				$username = "";
			}
		}
    }
?>

<html>
	<head>
		<title>Admin Control Panel</title> 
		
	<link rel="stylesheet" href="../res/styles/styles.css" media="all" /> 
	</head>


<body> 

	<div class="main_wrapper">
	
	
		<div id="header"></div>
		
		<div id="left">
		<h2 style="text-align:center;">Login</h2>
			
		
		</div>
		
		<div id="right">
            
            <form action="login.php" method="post">
            <center>
            <table border="2" style="text-align:center;">
                <caption>Sign In</caption>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass" /></td>
                </tr>

                <tr>
                    <td rowspan="2" colspan="2"><input type="submit" value="Login" name="login"/></td>
                </tr>
            </table>
            </center>
            </form>
		
		</div>

	</div>

</body>
</html>