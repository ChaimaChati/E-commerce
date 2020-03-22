<?php include ( "inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}
$emails = "";
$passs = "";
if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = ($_POST['email']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$password_login = ($_POST['password']);		
		$num = 0;
		$password_login_md5 = ($password_login);
		$sql="SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5'";
		$result=$conn->query($sql);
		$num = $result->rowcount();
		$get_user_email = $result->fetch(PDO::FETCH_ASSOC);
			$get_user_uname_db = $get_user_email['id'];
		if ($num>0) {
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			
			if (isset($_REQUEST['ono'])) {
				$ono = ($_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}
		else {
			header("location:signin.php");
			
			
		}
	}

}

?>

<!doctype html>
<html>
	<head>
		<title>Login</title>
		    <link rel="icon" href="img/core-img/favicon.ico">

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<style type="text/css">
			.home-welcome-text{
				background-image: url(image/bg.jpg);
				background-size: 1540px 800px;
				background-repeat: no-repeat;	
				background-attachment: fixed;
				background-position: center;
		}	
		.signupbutton{border-color: #FFA500;}
		.uisignupbutton:hover {
		  background-color: #FFA500;
			}
			.signupbox{border-color:#FFA500;}
			::placeholder{
				color:#556260;
			}
			
		</style>
	</head>
	<body class="home-welcome-text" style=" width: 100%;" >
		<div >
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 110px;">
					<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 150px; width: 160px;" src="img/core-img/logo1.png">
				</a>
			</div>
			
		</div>
		<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px; ">
			<div class="container" style="width: 500px; height: 230px; padding: 5%; background-color: rgba(0,0,0,0.3); border-radius: 15px;">
					
							<div class="signupform_text"> <center><h3>LOGIN FORM </h3> </center> </div>
							<div>
								<form action="" method="POST" class="registration">
									<div class="signup_form" style="margin-left: 50px;">
										<?php
												echo '
										<div >
											<td>
												<input name="email" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="'.$emails.'">
											</td>
										</div>
										<div>
											<td>
												<input name="password" id="password-1" required="required"  placeholder="Enter Password" class="password signupbox " type="password" size="30" value="'.$passs.'">
											</td>
										</div>
										<div>
											<input name="login" class="uisignupbutton signupbutton" type="submit" value="Log In">
										</div>
										';
											
										  ?>
										
										<div class="signup_error_msg">
											<?php 
												if (isset($error_message)) {echo $error_message;}
												
											?>
										</div>
									</div>
								</form>
								
						</div>
					
				
			</div>
		</div>
	</body>
</html>