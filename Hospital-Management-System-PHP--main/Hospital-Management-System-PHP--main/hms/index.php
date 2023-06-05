


<!DOCTYPE html>
<html>
<head>
	<title> HIS Home page</title>
</head>
<body style="background-image: url(img/homebackground.jpg); background-repeat: no-repeat;">
	<?php
	include("include/header.php");
	?>

	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3 mx-1 my-5">
					<img src="img/announcement.png" style="width:270px; height:230px; margin-right: 100px;">
					<h6 class="text-center">Announcement</h6>
					<a href="patientlogin.php">
						<button class="btn btn-success my-3" style="margin-left: 30%;"> Announcement </button>
					</a>
				</div>
				<div class="col-md-4 mx-1 my-5">
					<img src="img/patient.png" style="width: 100%;">
					<h6 class="text-center">Create Account As A Patient</h6>
					<a href="account.php">
						<button class="btn btn-success my-3" style="margin-left: 30%;"> Create Account </button>
					</a>
				</div>
				<div class="col-md-4 mx-1 my-5">
					<img src="img/doctor.png" style="width:220px; height:230px; margin-left: 50px;">
					<h6 class="text-center">Apply For A Job</h6>
					<a href="apply.php">
						<button class="btn btn-success my-2" style="margin-left: 35%;"> Apply Now </button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br>

        <?php
        include("include/footer.php");
        ?>



</body>
</html>