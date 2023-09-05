
<?php
error_reporting(0);
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

    if(isset($_POST['submit']))
    {
		$username=$_POST['username'];
		$image=$_POST['image'];
        $location=$_POST['location'];
        $production=$_POST['production'];
        $represantation=$_POST['represantation'];
        $field=$_POST['field'];
        $password=$_POST['password'];
    // //for getting product id
    // $query=mysqli_query($con,"select max(id) as pid from products");
    //     $result=mysqli_fetch_array($query);
    //      $productid=$result['pid']+1;
    //     $dir="productimages/$productid";
    // if(!is_dir($dir)){
    //         mkdir("productimages/".$productid);
    //     }
    
    //     move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
    //     move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
    //     move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
    $sql=mysqli_query($con,"insert into seller(username,image,location,production,represantation,field,password) values('$username','$image','$location','$production','$represantation','$field','$password')");
    $_SESSION['msg']="Seller Added Successfully !!";
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Add Seller</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add Seller</h3>
							</div>
                            <div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>
						<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post">
<div class="control-group">
<label class="control-label" for="basicinput">Seller Name</label>
<div class="controls">
<input type="text" name="username" placeholder="Enter Seller Name" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">location</label>
<div class="controls">
<input type="text" name="location" placeholder="Enter seller location" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">production</label>
<div class="controls">
<input type="text" name="production" placeholder="Enter production" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">represantation</label>
<div class="controls">
<input type="text" name="represantation" placeholder="Enter represantation" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">field</label>
<div class="controls">
<input type="text" name="field" placeholder="Enter field" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">password</label>
<div class="controls">
<input type="password" name="password" placeholder="Enter Password" class="span8 tip" required>
</div>
</div>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Add Seller</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>