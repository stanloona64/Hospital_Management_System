<?php
	session_start();
	include("include/connection.php");
	
	if(isset($_POST['login'])) {
		$username = $_POST['uname'];
		$password = $_POST['pass'];

		$error = array();

		if (empty($username)) 
		{
			$error['admin'] = "Enter Username";
		}
		else if (empty($password))
		{
			$error['admin'] = "Enter Password";
		}

		if (count($error)==0) {
			
			$query = "SELECT * FROM admin WHERE username ='$username' AND password = '$password'";

			$result = mysqli_query($connect,$query);

			if (mysqli_num_rows($result) == 1) 
			{
				echo "<script>alert('You logined as Admin')</script>";

				$_SESSION['admin'] = $username;

				header("Location:admin/index.php");
				exit();
			}
			else
			{
				echo "<script>alert('Invalid Username or Password')</script>";
			}
		}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Page</title>
</head>
<body style="background-image: url(img/background.jpg); background-repeat: no-repeat; background-size: cover;">

	<?php
	include("include/header.php");
	?>

	<div style="margin-top: 60px;"></div>
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-6 jumbotron">
					<img src="img/login.png" class="col-md-12">
					<form method="post" class="my-2">
							<div>
								<?php
									if(isset($error['admin']))
									{
										$sh = $error['admin'];

										$show = "<h4 class='alert alert-danger'>$sh</h4>";
									}
									else
									{
										$show = "";
									}

									echo $show;
								?>
							</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="uname" class="form-control"
							autocomplete="off" placeholder="Enter Username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="pass" class="form-control"
							autocomplete="off" placeholder="Enter Password">
						</div>
						<input type="submit" name="login" class="btn btn-success" value="Login">
					</form>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>
	</div>

    <?php
    include("include/footer.php");
    ?>

</body>
</html>