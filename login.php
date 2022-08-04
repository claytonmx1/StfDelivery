<!DOCTYPE HTML>
<!--
    Template Used Below, Re Coded By ClaytonMx 
	templated.co @templatedco
-->
<?php
session_start();

if(isset($_SESSION['u_id'])){
	header("Location: index.php");
}
?>

<html>
	<head>
		<title>StfDelivery</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="index.php" class="logo">StfDelivery</a>
				<nav class="right">
				<a href="login.php" class="button alt">Log in</a>
                <a href="register.php" class="button alt">Register</a>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
					<li><a href="generic.php">Delivery</a></li>
					<li><a href="addresscheck.php">Address Radius Check</a></li>
					<li><a href="resturantmenus.php">Restaurant Menus</a></li>
					<li><a href="about.php">About/Contact</a></li>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="register.php">Register</a></li>
					<?php if (isset($_SESSION['u_id'])) { echo '<li><a href="accountdashboard.php">Account Dashboard</a></li>';} ?>
					<?php if (isset($_SESSION['u_id'])) { echo '<li><a href="logout.php">Logout</a></li>';} ?>
				</ul>
				<ul class="actions vertical">
					<!-- no login for now <a href="#" class="button alt">Log in</a> -->
				</ul>
			</nav>
			<script>
			function checkform() {
				if(document.form1.username.value == "" || document.form1.password.value == "") {
					alert("Username Or Password Field Blank...");
					return false;
				} else {
					return true;
				}
			}
		</script>
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h1>Account Login</h1>
						<p></p>
					</header>
					<!--<div class="image fit">
						<img src="images/saintfranhouse.jpg" alt="" />
                    </div>  no image for our delivery form-->
									<form name="form1" id="form1" method="post" action="login_user.php" autocomplete="off">
										<div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
											<label for="name">Username</label>
												<input type="text" name="username" id="username" value="" placeholder="Username" />
											</div>
                                            <div class="6u 12u$(xsmall)">
											<label for="name">Password</label>
												<input type="password" name="password" id="password" value="" placeholder="Password" />
											</div>
											<!-- Break -->
											<!-- Break -->
											<!-- Break -->
											<div class="12u$">
												<ul class="actions">
													<li><button type="submit" name="submit" onclick="return checkform()">Login</button></li>
												</ul>
											</div>
										</div>
									</form>
					
				</div>
			</section>

		<!-- Footer -->
        <footer id="footer">
            <div class="inner">
                <h2>Get In Touch</h2>
                <ul class="actions">
                    <li><span class="icon fa-envelope"></span> <a href="#">claytonmx3@gmail.com</a></li>
                    <li><span class="icon fa-map-marker"></span> Saint Francisville, LA 70775</li>
					<li><span class="icon fa-facebook"></span> <a href="https://www.facebook.com/stfdelivery">StfDelivery</a></li>
                </ul>
            </div>
            <div class="copyright">
                &copy; ClaytonMx
            </div>
        </footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>