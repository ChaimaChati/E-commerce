<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
$u_pass = $_POST['password'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
			
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');

		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
			
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');

		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		$check = 0;
		$sql="SELECT email FROM `user` WHERE email='$u_email'";
		$result = $conn->query($sql);

		$email_check = $result->fetch(PDO::FETCH_ASSOC);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <20 ) {
			if (strlen($_POST['last_name']) >2 && strlen($_POST['last_name']) <20 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >1 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
						$_POST['password'] = $_POST['password'];
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
						$sql="INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')";
								$result = $conn->query($sql);

						
					}else {
						throw new Exception('Make strong password!');
					}
				}else {
					throw new Exception('Email already taken!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
			}else {
			throw new Exception('Lastname must be 2-20 characters!');
		}
		}else {
			throw new Exception('Firstname must be 2-20 characters!');
		}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>


<!doctype html>
<html>
	<head>
		<title>Sign UP</title>
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
	<body class="home-welcome-text" >
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
		<?php 
			if(isset($success_message)) {header("location:login.php");}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 50px; ">
						<div class="container"  style="width: 500px; height: 450px; padding: 5%; background-color: rgba(0,0,0,0.3); border-radius: 15px;">
							
								
									<div class="signupform_content">
										
										<div class="signupform_text"><center><h3>SIGN UP FORM </h3> </center></div>
										<div>
											<form action="" method="POST" class="registration">
												<div class="signup_form" style="margin-left: 50px;">
													<div>
														<td >
															<input name="first_name" id="first_name" placeholder="First Name" required="required" class="first_name signupbox" type="text" size="30" value="'.$u_fname.'" >
														</td>
													</div>
													<div>
														<td >
															<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="last_name signupbox" type="text" size="30" value="'.$u_lname.'" >
														</td>
													</div>
													<div>
														<td>
															<input name="email" placeholder="Email" required="required" class="email signupbox" type="email" size="30" value="'.$u_email.'">
														</td
			>										</div>
													<div>
														<td>
															<input name="mobile" placeholder="Phone number" required="required" class="email signupbox" type="text" size="30" value="'.$u_mobile.'">
														</td>
													</div>
													<div>
														<td>
															<input name="signupaddress" placeholder="Full Address" required="required" class="email signupbox" type="text" size="30" value="'.$u_address.'">
														</td>
													</div>
													<div>
														<td>
															<input name="password" id="password-1" required="required"  placeholder="Password" class="password signupbox " type="password" size="30" value="'.$u_pass.'">
														</td>
													</div>
													<div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Sign Up">
													</div>
													<div class="signup_error_msg">';
														
															if (isset($error_message)) {echo $error_message;}
															
														
													echo'</div>
												</div>
											</form>
											
										</div>
									</div>
								</div>
							
					</div>
				';
			}

		 ?>
	</body>
</html>
