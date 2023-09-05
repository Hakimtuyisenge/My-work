<?php
session_start();
error_reporting(0);
include('includes/config.php');

$pid = intval($_GET['pid']);

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $pid";
$query = mysqli_query($con, $sql);
$product = mysqli_fetch_assoc($query);

if (!$product) {
    // Handle product not found
    echo "Product not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title><?php echo htmlentities($product['productName']); ?> Details</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/config.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body class="cnt-home">
<header class="header-style-1">
    <!-- Include your header content here -->
		<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<div class="breadcrumb">
    <div class="container">
        <!-- Include your breadcrumb content here -->
    </div>
</div>
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product outer-bottom-sm'>
            <div class='col-md-9'>
                <div class="row  wow fadeInUp">
                    <!-- Move the image section to the left -->
                    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                        <div class="product-item-holder size-big single-product-gallery small-gallery">
                            <div id="owl-single-product">
                                <div class="single-product-gallery-item" id="slide1">
                                    <a data-lightbox="image-1" data-title="<?php echo htmlentities($product['productName']); ?>"
                                       href="<?php echo htmlentities($product['image']); ?>">
                                        <img class="img-responsive" alt=""
                                             src="<?php echo htmlentities($product['image']); ?>">
                                    </a>
                                </div>
                            </div>
                        </div><!-- /.single-product-gallery -->
                    </div><!-- /.gallery-holder -->

                    <!-- Move the product info to the right -->
                    <div class='col-sm-6 col-md-7 product-info-block'>
                        <div class="product-info">
                            <h1 class="name"><?php echo htmlentities($product['productName']); ?></h1>
                            <!-- Description -->
                            <div class="description">
                                <?php echo htmlentities($product['productDescription']); ?>
                            </div>
                            
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.col -->
        </div><!-- /.single-product -->
    </div><!-- /.container -->
</div><!-- /.body-content --><!-- /.body-content -->
<footer>
    <!-- Include your footer content here -->
	<?php include('includes/footer.php');?>
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
</footer>
</body>
</html>