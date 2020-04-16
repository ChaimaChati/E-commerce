<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$sql="SELECT * FROM user WHERE id='$user'";
	$result=$conn->query($sql);
	//$result = mysql_query("SELECT * FROM user WHERE id='$user'");
		$get_user_email = $result->fetch(PDO::FETCH_ASSOC);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];
			$ulast_db=$get_user_email['lastName'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = ($_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

if (isset($_REQUEST['cid'])) {
		$cid = ($_REQUEST['cid']);
		if(mysql_query("DELETE FROM orders WHERE pid='$cid' AND uid='$user'")){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}

$search_value = "";


//order

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
        <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
     .Mybtn {
  display: inline-block;
  min-width: 40px;
  height: 40px;
  color: #ffffff;
  border: none;
  border-radius: 0;
  padding: 0 7px;
  font-size: 18px;
  line-height: 56px;
  background-color: #FFA500;
  font-weight: 400; }
  .Mybtn.active, .Mybtn:hover, .Mybtn:focus {
    font-size: 18px;
    color: #ffffff;
    background-color: white; }
	</style>
   

</head>

<body>
    <div class="main-content-wrapper d-flex clearfix">
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
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
                <a href="index.php">
                    <img src="img/core-img/logo1.png" alt="" style="width: 400px; height: 200px;">
                </a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="OurProducts/shop.php">Shop</a></li>
                    <li><a href="checkout.php">Comment</a></li>
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
                            echo '<a  class="btn amado-btn mb-15">Hi '.$uname_db.'</a>';
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
            
               echo' <a href="mycart.php?uid='.$user.'" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart </a>';
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
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>
                        
                            
                                <div>
                                    <div class="cart-table clearfix">
                                        <table class="table table-responsive">
                                            <thead >
                                                <tr>
                                                    <th>picture</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Pieces</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php include ( "inc/connect.inc.php");
									$query = "SELECT * FROM cart WHERE uid='$user' ORDER BY id DESC";
									$run = $conn->query($query);
									$total = 0;
									while ($row=$run->fetch(PDO::FETCH_ASSOC)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										
										//get product info
										$query1 = "SELECT * FROM products WHERE id='$pid'";
										$run1 = $conn->query($query1);
										$row1=$run1->fetch(PDO::FETCH_ASSOC);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$description = $row1['description'];
										$picture = $row1['picture'];
										$item = $row1['item'];
										$category = $row1['category'];

										$total += ($quantity*$price);
										$_SESSION['total'] = $total;
									 ?>
                                                    <td class="cart_product_img" >
                                                        <?php echo '<a href="OurProducts/view_product.php?pid='.$pId.'"><img src="image/product/'.$item.'/'.$picture.'" alt="Product" style="width: 200px; height: 200px;"></a>' ?>
                                                    </td>
                                                    <td class="cart_product_desc" style="margin-right: -10px;"  >
                                                       <strong><?php echo $pName; ?></strong> 
                                                    </td>
                                                    <td class="price" style="margin-right: -50px;">
                                                        <span ><strong><?php echo $price; ?></strong></span>
                                                    </td>
                                                    <td class="qty" style="margin-right: -50px;">
                                                        <div class="qty-btn d-flex">
                                                            <p>Qty</p>
                                                            <div class="quantity">
                                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty2'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                                <input type="number" class="qty-text" id="qty2" step="1" min="1" max="300" name="quantity" value="1">
                                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty2'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                   
                                                    <td class="cart_product_desc">
                                                        <?php echo '<div class="btn Mybtn " style="width=1px;"><a href="delete_cart.php?cid='.$pId.'" style="text-decoration: none;">X</a>
												</div>' ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                           

                    </div>
                     <div class="col-12 col-lg-3">
                            <div class="cart-summary">
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <li><span>subtotal:</span> <span>$
                                            <?php echo $total ?></span></li>
                                    <li><span>delivery:</span> <span>Free</span></li>
                                    <li><span>total:</span> <span>$
                                            <?php echo $total ?></span></li>
                                </ul>
                                <div class="cart-btn mt-100">
                                    <a href="checkout.php" class="btn amado-btn w-100">Comment</a>
                                </div>
                            </div>
                        </div>
                       </div>
                </div>
            </div>
         </div>
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
