<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>

	<title>Annual University Magazine FPT University of Greenwich | Contact Us</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<?php include_once('includes/header.php'); ?>
	<div class="site-main-container">
		<!-- Start top-post Area -->
		<section class="top-post-area pt-10">
			<div class="container no-padding">
				<div class="row">
					<div class="col-lg-12">
						<div class="hero-nav-area">
							<h1 class="text-white">Contact Us</h1>
							<p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span><a href="contact.php">Contact Us </a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End top-post Area -->
		<!-- Start contact-page Area -->
		<section class="contact-page-area pt-50 pb-120">
			<div class="container">
				<div class="row contact-wrap">
					<?php

					$sql = "SELECT * from  tblpage where PageType='contactus'";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);
					$cnt = 1;
					if ($query->rowCount() > 0) {
						foreach ($results as $row) {               ?>
							<div class="map-wrap">
								<p></p>
							</div>
							<div class="col-lg-3 d-flex flex-column address-wrap">
								<div class="single-contact-address d-flex flex-row">
									<div class="icon">
										<span class="lnr lnr-home"></span>
									</div>
									<div class="contact-details">
										<h5><b>Address</b></h5>
										<p>
											<?php echo $row->PageDescription; ?>
										</p>
									</div>
								</div>
								<div class="single-contact-address d-flex flex-row">
									<div class="icon">
										<span class="lnr lnr-phone-handset"></span>
									</div>
									<div class="contact-details">
										<h5><b>Phone Number</b></h5>
										<?php echo $row->MobileNumber; ?>
										<p>Monday - Saturday <br> 09:00 AM - 05:00 PM</p>
									</div>
								</div>
								<div class="single-contact-address d-flex flex-row">
									<div class="icon">
										<span class="lnr lnr-envelope"></span>
									</div>
									<div class="contact-details">
										<h5><b>Email</b></h5>
										<?php echo $row->Email; ?>
										<p>Send us your questions</p>
									</div>
								</div>
							</div>

				</div><?php $cnt = $cnt + 1;
						}
					} ?>
			</div>
		</section>
		<!-- End contact-page Area -->
	</div>
	<!-- start footer Area -->
	<?php include_once('includes/footer.php'); ?>
	<!-- End footer Area -->
	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="js/easing.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/mn-accordion.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mail-script.js"></script>
	<script src="js/main.js"></script>
</body>

</html>