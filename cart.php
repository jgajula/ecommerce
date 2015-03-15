<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'image'=>$productByCode[0]["image"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +1 888 488 4968</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@mystyle.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a target="_blank" href="https://www.facebook.com/pages/Unofficial-MyStyle/456566094522842"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://twitter.com/iwmy2012"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/define-my-style"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="https://plus.google.com/100066114457703852702"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html">
                                <!--<img src="images/home/logo.png" alt="" />-->
                                <canvas id="idLogo" width="139" height="39">
                                    <b>This browser does not support HTML5 Canvas!</b>
                                </canvas>
                            </a>
                        </div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.php">Cart</a></li>
										<li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->



<?php
 if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>


<?php
                    foreach ($_SESSION["cart_item"] as $item){
                		?>


<tr>
    <td class="cart_product">
        <a href=""><img src="<?php echo "images/".$item["image"]; ?>" alt=""></a>
    </td>
    <td class="cart_description">
        <h4><a href=""><?php echo $item["name"]; ?></a></h4>
        <p>Web ID: <?php echo $item["code"]; ?></p>
    </td>
    <td class="cart_price">
        <p><?php echo $item["price"]; ?></p>
    </td>
    <td class="cart_quantity">
        <p><?php echo $item["quantity"]; ?></p>
    </td>
    <td class="cart_total">
        <p class="cart_total_price"><?php echo $item["quantity"] * $item["price"]; ?></p>
    </td>
    <td class="cart_delete">
        <a class="cart_quantity_delete" href="cart.php?action=remove&code=<?php echo $item["code"]; ?>"><i class="fa fa-times"></i></a>
    </td>
</tr>



		<?php
$item_total += ($item["price"]*$item["quantity"]);
}
?>

					</tbody>
				</table>
				  <?php
                }
                ?>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo $item_total; ?></span></li>
							<li>Tax <span><?php echo 0.1* $item_total; ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php echo $item_total + 0.1*$item_total ?></span></li>
						</ul>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<footer id="footer"><!--Footer-->
		
	<footer id="footer"><!--Footer-->

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/contact-us.html">Contact Us</a></li>
								<li><a href="/faq.html">FAQ's</a></li>
                                <li><a href="/new.html">What's New</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/tshirt.php">T-Shirt</a></li>
								<li><a href="/men.php">Mens</a></li>
								<li><a href="/women.php">Womens</a></li>
								<li><a href="/shoes.php">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/terms.html">Terms of Use</a></li>
								<li><a href="/privacy.html">Privecy Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/">Home</a></li>
								<li><a href="/about.html">About Us</a></li>
								<li><a href="/jobs.html">Jobs</a></li>
								<li><a href="/blog.php">Blog</a></li>
								<li><a href="/support.html">Support</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2015 Mystyle Inc. All rights reserved.</p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="js/canvas.js"></script>
</body>
</html>