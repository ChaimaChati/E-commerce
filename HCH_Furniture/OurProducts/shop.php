<?php include ( "../inc/connect.inc.php" ); ?>
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
        <link rel="icon" href="../img/core-img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">

</head>
<body>
	 <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>
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
                    <li ><a href="../index.php">Home</a></li>
                    <li class="active"><a href="shop.php">Shop</a></li>
                
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
         <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li ><a href="shop.php">All</a></li>
                        <li><a href="beds.php">Beds</a></li>
                        <li><a href="chairs.php">chairs</a></li>
                        <li><a href="homedeco.php">Home Deco</a></li>
                        <li><a href="lamps.php">lamps</a></li>
                        <li><a href="tables.php">Tables</a></li>
                    </ul>
                </div>
            </div>

            

            <!-- ##### Single Widget ##### -->
            <div class="widget color mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Color</h6>

                <div class="widget-desc">
                    <ul class="d-flex">
                        <li><a href="#" class="color1"></a></li>
                        <li><a href="#" class="color2"></a></li>
                        <li><a href="#" class="color3"></a></li>
                        <li><a href="#" class="color4"></a></li>
                        <li><a href="#" class="color5"></a></li>
                        <li><a href="#" class="color6"></a></li>
                        <li><a href="#" class="color7"></a></li>
                        <li><a href="#" class="color8"></a></li>
                    </ul>
                </div>
            </div>

            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price">$10 - $1000</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <p>Showing 1-8 0f 25</p>
                                <div class="view d-flex">
                                    <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortBydate">
                                            <option value="value">Date</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Popular</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>
                                    <form action="#" method="get">
                                        <select name="select" id="viewProduct">
                                            <option value="value">12</option>
                                            <option value="value">24</option>
                                            <option value="value">48</option>
                                            <option value="value">96</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 </div>



	
	<div style="padding: 15px 0px; font-size: 15px; margin: 0 auto; display: table; width: 100%;">
		<div>
		<?php 
			$sql="SELECT * FROM products WHERE available >='1' AND item ='all'  ORDER BY id ";
			$result = $conn->query($sql);
			
				$num_rows = $result->fetchColumn();
				
					if ($num_rows) {
					echo '<ul id="recs">';

					
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];


						echo '
							<ul style="float: left;">
								<li style="float: center; padding: 0px 15px 25px 25px;">
																<div class="single-product-wrapper">

									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
									<div class="product-img">
                                	<img src="../image/product/all/'.$picture.'" alt="" style="width: 400px; height: 400px">
                            		</div>
									<div class="product-description d-flex align-items-center justify-content-between">
                                	<!-- Product Meta Data -->
                                	<div >
                                    <div class="line"></div>
                                    <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.'
                                	</div>
                                <!-- Ratings & Cart -->
	                                <div class="ratings-cart text-right">
	                                    <div class="ratings">
	                                        <i class="fa fa-star" aria-hidden="true"></i>
	                                        <i class="fa fa-star" aria-hidden="true"></i>
	                                        <i class="fa fa-star" aria-hidden="true"></i>
	                                        <i class="fa fa-star" aria-hidden="true"></i>
	                                        <i class="fa fa-star" aria-hidden="true"></i>
	                                    </div>
	                                    <div class="cart">
	                                        <a  data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="../img/core-img/cart.png" alt=""></a>
	                                    </div>
	                                </div>
								</li>
							</ul>
						';

						}
				}	
		?>
			
		</div>
	</div>
	
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
