<?php
include('config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Africa/Kigali');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
}
?>
<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.php">
				  BUSINESS IDEAS SUPPORT SYSTEM | Seller
			  	</a> 
				
				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">
						<li><a href="#">
							<?php echo($_SESSION['alogin'])?>
						</a></li>
						<?php $query=mysqli_query($con,"select * from seller");
						while($row=mysqli_fetch_array($query))
						{
						?>
						<li class="nav-user dropdown">
							<?php
                                if ($row['image'] == '') {

                            ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/user.png" class="nav-avatar" />
								<b class="caret"></b>
							</a> 
							<?php } ?>
							<ul class="dropdown-menu">
								<li><a href="change-profilepic.php">Upload Profile Picture</a></li>
								<li><a href="change-password.php">Change Password</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
						<?php } ?>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
