<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $sql_p="SELECT * FROM products WHERE id={$id}";
        $query_p=mysqli_query($con,$sql_p);
        if(mysqli_num_rows($query_p)!=0){
            $row_p=mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']]=array("quantity" => 0, "price" => $row_p['productPrice']);
        }else{
            $message="Product ID is invalid";
        }
    }
        echo "<script>alert('Product has been added to the cart')</script>";
        echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
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

    <title> BUSINESS IDEAS SUPPORT SYSTEM</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body class="cnt-home">
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
        <?php include('includes/menu-bar.php');?>
    </header>
    
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container homepage-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                        <?php include('includes/side-menu.php');?>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                        <div id="hero" class="homepage-slider3">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                <div class="full-width-slider">	
                                    <div class="item" style="background-image: url(assets/images/sliders/bg_1.jpg);">
                                    </div>
                                </div>
                                
                                <div class="full-width-slider">
                                    <div class="item full-width-slider" style="background-image: url(assets/images/bg_2.jpg);">
                                    </div>
                                </div>
                
                                <div class="full-width-slider">
                                    <div class="item full-width-slider" style="background-image: url(assets/images/sliders/bg_3.jpg);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="section featured-product inner-xs wow fadeInUp">
                    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                        <?php include('includes/footer.php');?>
                    </div>
                </section>
            </div>
        </div>

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
    </div>
</body>
</html>
