<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
    $user = "";
}
else {
    $user = $_SESSION['user_login'];
    $sql="SELECT * FROM user WHERE id='$user'";
    $result= $conn->query($sql);
        $get_user_email =$result->fetch(PDO::FETCH_ASSOC);
            $uname_db = $get_user_email['firstName'];
}

if (isset($_POST['submit'])) {
//declere veriable
$fname=$_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$country = $_POST['country'];
$town = $_POST['town'];
$zipcode = $_POST['zipcode'];
$comment = $_POST['comment'];
		
		// Check if livre code already exists
		
	
		if (strlen($_POST['comment']) >50 ) {
						
						
						$sql="INSERT INTO comment (fName,lName,email,country,town,zipcode,comment) VALUES ('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[country]','$_POST[town]','$_POST[zipcode]','$_POST[comment]')";
								$result = $conn->query($sql);
								
						
		}else {
						throw new Exception('comment should be above 50 characters');
					}

	
}


?>





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IA=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Messages </title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
   
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php">
                                      <img src="img/core-img/logo1.png" alt="" style="width: 400px; height: 200px;">

                </a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="OurProducts/shop.php">Shop</a></li>
                    <li class="active"><a href="checkout.php">Comment</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <?php 
                        if ($user!="") {
                            echo '<a  href="logout.php" class="btn amado-btn mb-15">LOG OUT</a>';
                        }
                        else {
                            echo '<a  href="signin.php" class="btn amado-btn mb-15">SIGN UP</a>';
                        }
                     ?>
                <?php 
                        if ($user!="") {
                            echo '<a href="profile.php?uid='.$user.'" class="btn amado-btn mb-15">Hi '.$uname_db.'</a>';
                        }
                        else {
                            echo '<a  href="login.php" class="btn amado-btn mb-15">LOG IN</a>';
                        }
                     ?>

            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100" style="margin-top: -50px;">
            <?php 
            if ($user!="") {
            
               echo' <a href="mycart.php?uid='.$user.'" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>';
               echo' <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>';
            }
            ?>

            
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between" style="margin-top: 200px;">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 mb-2">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Comment</h2>
                            </div>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="first_name" name="fname" value="" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="last_name" name="lname" value="" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="city" name="country" placeholder="country" value="">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="city" name="town" placeholder="Town" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="zipCode" name="zipcode" placeholder="Zip Code" value="">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" name="comment" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order" required></textarea>
                                    </div>
                                   
                                    <div class="col-md-4 mb-3">
                                     <div class="cart-btn mt-100">
                                         <button type="submit" name="submit" value="submit" class="btn amado-btn w-100">submit
                                        </button>
                                       
                                    </div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.php">    <img src="img/core-img/logo1.png" alt="" style="width: 200px; height: 100px;">  </a>

                            
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="OurProducts/shop.php">Shop</a>
                                        </li>
                                        
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.php">Comment</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>
