<!DOCTYPE HTML>
<!--
    Template Used Below, Re Coded By ClaytonMx 
	templated.co @templatedco
-->

<?php
include 'dbh.inc.php';
session_start();
if(!isset($_SESSION['u_id'])){
	header("Location: login.php");
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
			<script>
			function checkform() {
				if(document.form1.address.value == "" || document.form1.phone.value == "" || document.form1.category.value == "" || document.form1.orderlocation.value == "" || document.form1.ordername.value == "") {
					alert("You Forgot Some Info ;)");
					return false;
				} else {
					return true;
				}
			}
		</script>
		<!-- Main -->
			<?php
			//setting if we closed or open
			$sql5 = "SELECT * FROM areweopen";
			$result5 = mysqli_query($conn, $sql5);

				if($row5 = mysqli_fetch_assoc($result5)) {
    			$storestatus = $row5['store'];
			}
			?>
			<?php
			if($storestatus == 'open'){
			?>

			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h1>Delivery Form</h1>
						<p></p>
					</header>
					<!--<div class="image fit">
						<img src="images/saintfranhouse.jpg" alt="" />
                    </div>  no image for our delivery form-->
							<h3 style="color: red;">*If Food Is Not Paid For Over The Phone With Resturant, It Will Not Be Picked Up And Delivered*</h3>
							<h3 style="color: red;">*Check Your Delivery Address On The Address Radius Check Page Before Ordering!!!!*</h3>
									<form name="form1" id="form1" method="post" action="submitdelivery.php" autocomplete="off">
										<div class="row uniform">
											<div class="6u$ 12u$(xsmall)">
											<label for="name">Order Pickup Name</label>
												<input type="text" name="ordername" id="ordername" value="" placeholder="Name Used To Place Order" />
											</div>
											<div class="6u$ 12u$(xsmall)">
											<label for="name">Delivery Address</label>
												<input type="text" name="address" id="address" value="" placeholder="Delivery Address" />
											</div>
											<div class="6u$ 12u$(xsmall)">
											<label for="name">Phone Number</label>
												<input type="text" name="phone" id="phone" value="" placeholder="Phone Number" />
											</div>
											<div class="6u$ 12u$(xsmall)">
											<label for="name">Order Location</label>
												<input type="text" name="orderlocation" id="orderlocation" value="" placeholder="Name Of Resturant" />
											</div>
											<div class="6u$ 12u$(xsmall)">
											<label for="name">Discount Code</label>
												<input type="text" name="discountcode" id="discountcode" value="" placeholder="" />
											</div>
											<!-- Break -->
											<div class="12u$">
												<div class="select-wrapper">
												<label for="name">PaymentType</label>
													<select name="category" id="category">
														<option value="">- Select Payment Option -</option>
														<option value="1">Cash</option>
														<option value="2">Card</option>
													</select>
												</div>
											</div>
											<!-- Break -->
											<div class="12u$">
											<label for="name">DeliveryInstructions</label>
												<textarea name="instructions" id="instructions" placeholder="Delivery Instructions, If Any..." rows="6"></textarea>
											</div>
											<!-- Break -->
											<div class="12u$">
												<ul class="actions">
													<li><button type="submit" name="submit" onclick="return checkform()">Submit Delivery</button></li>
												</ul>
											</div>
										</div>
									</form>
					
				</div>
			</section>
			<?php
			}elseif($storestatus == 'closed'){
			?>

<h3>*Delivery Service Is Currently Closed, Look On The About Page For Business Hours*</h3>

			<?php
			}
			?>

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