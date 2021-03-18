<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
	$_SESSION['token'] = bin2hex(random_bytes(32));
}
if (isset($_POST['submit'])) {
	if (!empty($_POST['csrftoken'])) {
		if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$comment = $_POST['comment'];
			$magid = $_GET['magzid'];
			$st1 = '1';
			$sql = "insert into tblcomments(postId,name,email,comment,status)values(:magid,:name,:email,:comment,:st1)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':magid', $magid, PDO::PARAM_STR);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->bindParam(':comment', $comment, PDO::PARAM_STR);
			$query->bindParam(':st1', $st1, PDO::PARAM_STR);

			$query->execute();
			if ($query) :
				echo "<script>alert('Comment successfully submit!');</script>";
				unset($_SESSION['token']);
			else :
				echo "<script>alert('Something went wrong. Please try again!');</script>";
			endif;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>

	<!-- Site Title -->
	<title>Magazine</title>
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
							<h1 class="text-white">Magazine Detail</h1>
							<p class="text-white link-nav"><a href="index.PHP">Home </a> <span class="lnr lnr-arrow-right"></span>Post Types <span class="lnr lnr-arrow-right"></span><a href="image-post.html">Single Magazine Detail</a></p>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- End top-post Area -->
		<!-- Start latest-post Area -->
		<section class="latest-post-area pb-120">
			<div class="container no-padding">
				<div class="row">
					<div class="col-lg-12 post-list">
						<!-- Start single-post Area -->
						<div class="single-post-wrap">
							<?php

							$magid = $_GET['magzid'];
							$sql = "SELECT tblmagazine.Title,tblmagazine.ID as mid,tblmagazine.PostDate,tblmagazine.Status,tblmagazine.Publisher,tblmagazine.Language,tblmagazine.AcademicYear,tblmagazine.CategoryID,tblmagazine.RemarkDate,tblmagazine.CoverImage,tblmagazine.UploadMagazine,tblmagazine.MagazineDescription,tblcategory.CategoryName,tblcategory.ID as cid,tbluser.FullName,tbluser.MobileNumber,tbluser.Email from tblmagazine join tblcategory on tblcategory.ID=tblmagazine.CategoryID join tbluser on tbluser.ID=tblmagazine.UserID where tblmagazine.ID='$magid'";
							$query = $dbh->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {               ?>
									<div class="feature-img-thumb relative">
										<div class="overlay overlay-bg"></div>
										<img src="user/images/<?php echo $row->CoverImage; ?>" alt="" height="524" width="468">
									</div>
									<div class="content-wrap">
										<ul class="tags mt-10">
											<li><?php echo htmlentities($row->CategoryName) ?></li>
										</ul>
										<h3><?php echo htmlentities($row->Title) ?></h3>
										<ul class="meta pb-20">
											<li><strong>Author: </strong><?php echo htmlentities($row->Publisher) ?></li>
											<br>
											<li><strong>Language: </strong><?php echo htmlentities($row->Language) ?></li>
											<br>
											<li><strong>Academic Year: </strong><?php echo htmlentities($row->AcademicYear) ?> </li>
											<br>
											<?php if ($row->AcademicYear == '2019') : ?>
												<a href="single-magazine-post.php?magzid=<?php echo htmlentities($row->mid) ?>">
													<li><strong>Date of Publishcation: </strong>10/30/2019</li>
												</a>
											<?php endif ?>
											<?php if ($row->AcademicYear == '2020') : ?>
												<a href="single-magazine-post.php?magzid=<?php echo htmlentities($row->mid) ?>">
													<li><strong>Date of Publishcation: </strong>09/25/2020</li>
												</a>
											<?php endif ?>
										</ul>
										<p>
											<b><b><?php echo htmlentities($row->MagazineDescription) ?></b></b>
										</p>
										<br>
										<iframe src="user/files/<?php echo $row->UploadMagazine; ?>" style="width:1000px; height:700px;" frameborder="0"></iframe><br />
										<hr>
								<?php $cnt = $cnt + 1;
								}
							} ?>

								<div class="comment-sec-area">
									<div class="container">
										<div class="row flex-column">

											<?php
											$magid = $_GET['magzid'];
											$sts = 1;
											$sql = "SELECT * from tblcomments where postId=:magid and status=:sts";
											$query = $dbh->prepare($sql);
											$query->bindParam(':magid', $magid, PDO::PARAM_STR);
											$query->bindParam(':sts', $sts, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											?>
											<h6><?php echo $query->rowCount(); ?>  Comments</h6>
											<div class="comment-list">
												<?php
												if ($query->rowCount() > 0) {
													foreach ($results as $row) {               ?>
														<div class="single-comment justify-content-between d-flex">
															<div class="user justify-content-between d-flex">
																<div class="thumb">
																	<img src="img/usericon.png" alt="">
																</div>
																<div class="desc">
																	<h5><?php echo htmlentities($row->name) ?> (<?php echo htmlentities($row->email) ?>)</h5>
																	<p class="date"><?php echo htmlentities($row->postingDate) ?> </p>
																	<p class="comment">
																		<b><?php echo htmlentities($row->comment) ?></b>
																	</p>
																	<hr>
																</div>
															</div>
														</div>
												<?php $cnt = $cnt + 1;
													}
												} else {
													echo "No comment yet";
												} ?>
											</div>


										</div>
									</div>
								</div>
									</div>
									<div class="comment-form">
										<h4>Post Comment</h4>
										<form name="Comment" method="post">
											<input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
											<div class="form-group form-inline">
												<div class="form-group col-lg-6 col-md-12 name">
													<input type="text" name="name" class="form-control" placeholder="Enter your name" required="true">
												</div>
												<div class="form-group col-lg-6 col-md-12 email">
													<input type="email" name="email" class="form-control" placeholder="Enter your email" required="true">
												</div>
											</div>
											<div class="form-group">
												<textarea class="form-control" name="comment" rows="3" placeholder="Comment" required="true"></textarea>
											</div>
											<button type="submit" class="btn btn-primary" name="submit">Post Comment</button>
										</form>
									</div>
						</div>
						<!-- End single-post Area -->
					</div>

				</div>
			</div>
		</section>
		<!-- End latest-post Area -->
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