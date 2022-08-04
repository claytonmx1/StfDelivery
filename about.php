<!DOCTYPE HTML>
<!--
    Template Used Below, Re Coded By ClaytonMx 
	templated.co @templatedco
-->
<?php
session_start();
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
					<li><a href="addresscheck.php">Address Radius Check</a></li>
					<li><a href="resturantmenus.php">Restaurant Menus</a></li>
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

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h1>About</h1>
						<p></p>
					</header>
					<h3>May Hours Of Business</h3>
					<div class="image fit">
						<img src="images/StfDelivery May Schedule.jpg" alt="" />
                    </div>
                    <p>*The days we are open will be posted above, from month to month. *</p>
                    <p>What is StfDelivery? - A food delivery service based locally in Saint Francisville.</p>
					<p>Pricing? - 10$ per delivery.</p>
                    <p>How Does It work? - Place your order at any of the resturants in Saint Francisville. Pay for your order over the phone with the resturant, then fill out the delivery form here and click pay online or select pay by cash in your account dashboard. If paying online, Once The delivery fee is paid your order will be picked up and delivered.</p>
                    <p>How Are Payments Handled? - Payment information is processed through Square. None of your payment information is used on this website. When you click pay you are then transfered to Square to complete the transaction.</p>
                    <p>Open/Close Time? - 10:30AM to 3:30PM *Closed On Weekends...Opening days will vary with my schedule for now.</p>
                    <p>Questions / Concerns? - Email us at the email below or contact us on Facebook at our StfDelivery page, link for the Facebook page down below!</p>
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