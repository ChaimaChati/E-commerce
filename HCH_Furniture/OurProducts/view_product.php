<?php include ( "../inc/connect.inc.php" ); ?>
<?php ?>
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
if (isset($_REQUEST['pid'])) {
	
	$pid =$_REQUEST['pid'];
}else {
	header('location: index.php');
}
			$sql="SELECT * FROM products WHERE id ='$pid'"  or die(mysql_error());
			$result = $conn->query($sql);
		
					if($result) {
						$row =  $result->fetch(PDO::FETCH_ASSOC);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$piece=$row['piece'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$available =$row['available'];
					}
if (isset($_POST['addcart'])) {
    if (!isset($_SESSION['user_login'])) {
        header('location: ../login.php');
    }
    else{
    $sql="SELECT * FROM cart WHERE pid ='$pid' AND uid='$user'" or die(mysql_error());
    $result = $conn->query($sql);

	if ($result->rowCount()) {
		header('location: ../mycart.php?uid='.$user.'');
	}else{
	    
	    $qty=$_POST['qty'];
        $sql="INSERT INTO cart (uid,pid,quantity) VALUES ('$user','$pid', '$qty')";
         $result = $conn->query($sql);
		if($result){
			header('location: ../mycart.php?uid='.$user.'');
		}else{ 
			header('location: index.php');
		}
	}
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Product</title>
        <link rel="icon" href="../img/core-img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		 <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">
    
    <style type="text/css">
		
 input[type=number] {
        /*for absolutely positioning spinners*/
        position: relative; 
        padding: 3px;
        padding-right: 2px;
        width:80px;
      }

      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
        opacity: 1;
      }

      input[type=number]::-webkit-outer-spin-button, 
      input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: inner-spin-button !important;
        width: 10px;
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
      }
	</style>

</head>
<body>
	
<div class="main-content-wrapper d-flex clearfix">

        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>
    <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="../index.php">
                    <img src="../img/core-img/logo1.png" alt="" style="width: 400px; height: 200px;">
                </a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="../index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="../checkout.php">Comment</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
           <div class="amado-btn-group mt-30 mb-100">
                <?php 
                        if ($user!="") {
                            echo '<a  href="../logout.php" class="btn amado-btn mb-15">LOG OUT</a>';
                        }
                        else {
                            echo '<a  href="../signin.php" class="btn amado-btn mb-15">SIGN UP</a>';
                        }
                     ?>
                <?php 
                        if ($user!="") {
                            echo '<a  class="btn amado-btn mb-15">Hi '.$uname_db.'</a>';
                        }
                        else {
                            echo '<a  href="../login.php" class="btn amado-btn mb-15">LOG IN</a>';
                        }
                     ?>

            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100" style="margin-top: -50px;">
            <?php 
            if ($user!="") {
            
                echo' <a href="../mycart.php?uid='.$user.'" class="cart-nav"><img src="../img/core-img/cart.png" alt=""> Cart </a>';
               echo' <a href="telecharger.php" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> rapport</a>';
            ?>

            
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between" style="margin-top: 200px;">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>

        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                
                <?php 
			echo '
			 <div class="row">

			<div class="col-12 col-lg-7">

				<div>
					<img src="../image/product/'.$item.'/'.$picture.'" style="height: 600px; width: 600px; margin-left:30px;">
				</div>
								</div>


				<div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">'.$price.'</p>
                                <a href="product-details.html">
                                    <h6>'.$pName.'</h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="#">Write A Review</a>
                                    </div>
                                </div>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                            </div>

                            <div class="short_overview my-5">
                                <p>'.$description.'</p>
                               
                            </div>
                           
                            <div>
							<div id="srcheader">
								<form id="" method="post" action="">
								  Quantity : <input type="number" value="1" step="1" name="qty" min="1" max="10"/><br><br>
								<button type="submit" name="addcart" value="Add to cart" class="btn amado-btn">Add to cart</button>
								
								</form><br/>
								
								<div class="srcclear"></div>
							</div>
						</div>

                          

                        </div>
                    </div>
			';
		?>
			</div>
	</div>
	</div>


	</div>
	<footer class="footer_area clearfix" style="margin-top: 50px;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.html">    <img src="img/core-img/logo1.png" alt="" style="width: 200px; height: 100px;">  </a>
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
                                            <a class="nav-link" href="index.html">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.html">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.html">Comment</a>
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
	<script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../js/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>
</body>
</html>


