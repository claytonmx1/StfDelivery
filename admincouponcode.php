<!DOCTYPE HTML>
<!--
    Template Used Below, Re Coded By ClaytonMx 
	templated.co @templatedco
-->
<?php
session_start();
include 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
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
				<?php if (isset($_SESSION['u_id'])) { echo '<a href="accountdashboard.php" class="button alt">Account Dashboard</a>';} ?>
				<?php if ($_SESSION['u_userlevel'] == '2') { echo '<a href="adminpanel.php" class="button alt">Admin Panel</a>';} ?>
				<?php if (!isset($_SESSION['u_id'])) { echo '<a href="login.php" class="button alt">Log in</a>';} ?>
				<?php if (!isset($_SESSION['u_id'])) { echo '<a href="register.php" class="button alt">Register</a>';} ?>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
					<li><a href="generic.php">Delivery</a></li>
					<li><a href="about.php">About/Contact</a></li>
					<?php if (!isset($_SESSION['u_id'])) { echo '<li><a href="login.php">Log in</a></li>';} ?>
                    <?php if (!isset($_SESSION['u_id'])) { echo '<li><a href="register.php">Register</a></li>';} ?>
					<?php if (isset($_SESSION['u_id'])) { echo '<li><a href="accountdashboard.php">Account Dashboard</a></li>';} ?>
					<?php if ($_SESSION['u_userlevel'] == '2') { echo '<li><a href="adminpanel.php">Admin Panel</a></li>';} ?>
					<?php if (isset($_SESSION['u_id'])) { echo '<li><a href="logout.php">Logout</a></li>';} ?>
				</ul>
				<ul class="actions vertical">
					<!-- no login for now <a href="#" class="button alt">Log in</a> -->
				</ul>
			</nav>
			<script>
			function checkform() {
				if(document.form1.openorclosed.value == "") {
					alert("Box Empty...");
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
						<h1>Admin Create Coupon Code</h1>
						<p></p>
					</header>
					<!--<div class="image fit">
						<img src="images/saintfranhouse.jpg" alt="" />
                    </div>  no image for our delivery form-->
									<form name="form1" id="form1" method="post" action="createcode.php">
										<div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
											<label for="name">Coupon Code Name</label>
												<input type="text" name="createdcode" id="createdcode" value="" placeholder="Create A Coupon Code" />
											</div>
                                            <div class="6u 12u$(xsmall)">
											<label for="name">Price</label>
												<input type="text" name="createdprice" id="createdprice" value="" placeholder="Price For Coupon Code" />
											</div>
											<!-- Break -->
											<!-- Break -->
											<!-- Break -->
											<div class="12u$">
												<ul class="actions">
													<li><button type="submit" name="submit" onclick="return checkform()">Create Code</button></li>
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