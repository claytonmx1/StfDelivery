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
	<meta http-equiv="refresh" content="300" >
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
				<?php if ($_SESSION['u_userlevel'] == '2') { echo '<a href="admin.php" class="button alt">Admin Dashboard</a>';} ?>
				<?php if ($_SESSION['u_userlevel'] == '2') { echo '<a href="adminstore.php" class="button alt">Admin StoreControls</a>';} ?>
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
					<?php if ($_SESSION['u_userlevel'] == '2') { echo '<li><a href="admin.php">Admin Dashboard</a></li>';} ?>
					<?php if ($_SESSION['u_userlevel'] == '2') { echo '<li><a href="adminstore.php">Admin StoreControls</a></li>';} ?>
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
         <?php if (isset($_SESSION['u_id'])) {
		date_default_timezone_set('America/Chicago');
		$userid = $_SESSION['u_id'];
        $payedcheck = 'PayingCash';
        $paymentcheck = 'Payment Completed, Waiting For Food...';
    $user_info = mysqli_query($conn,"SELECT * FROM delivery");
         
    echo"
			<section id='main' class='wrapper'>
            <h3>Admin Dashboard</h3>
            <h4>Order List</h4>
									<div class='table-wrapper'>
                                        <table class='alt'>
											<thead>
                                                <tr>
													<th>OrderID</th>
													<th>Order Location</th>
													<th>Pickup Name</th>
                                                    <th>Delivery Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Delivery Status</th>
													<th>OrderTime</th>
													<th>PickupTime</th>
													<th>Instructions</th>
                                                    <th>PayType</th>
                                                    <th>Confirm Payment</th>
													<th>Send Update Text</th>
													<th>Complete Delivery</th>
												</tr>
                                            </thead>
                                            ";                                        
                                            while($row2 = mysqli_fetch_array($user_info)){

                
											echo "<tbody>";
                                                echo "<tr>";
                                                    echo "<td>" . $row2['id'] . "</td>";
													echo "<td>" . $row2['orderlocation'] ."</td>";
													echo "<td>" . $row2['ordername'] . "</td>";
                                                    echo "<td>" . $row2['deliveryaddress'] . "</td>";
                                                    echo "<td>" . $row2['phonenumber'] . "</td>";
                                                    echo "<td>" . $row2['status'] . "</td>";
													echo "<td>" . $row2['time'] . "</td>";
													echo "<td>" . $row2['pickuptime'] . "</td>";
													echo "<td>" . $row2['instructions'] . "</td>";
                                                    if($row2['paytype'] == 'Card'){
                                                        echo "<td>" . $row2['paytype'] . "</td>";
                                                    }else if ($row2['paytype'] == 'Cash'){
                                                        echo "<td>" . $row2['paytype'] . "</td>";
                                                    }
                                                    if($row2['paytype'] == 'Card' && $row2['status'] == $paymentcheck){
														echo "<td>Order Marked As Paid</td>";
													}
                                                    if($row2['paytype'] == 'Card' && $row2['status'] != $paymentcheck){
													echo "<td><form action='confirmpayment.php' method='post'><button type='submit' name='payorderid' value='". $row2['id'] ."'>Confirm Payment</button></form></td>";
                                                    }else if ($row2['paytype'] == 'Cash'){
                                                        echo "<td>" . $payedcheck . "</td>";
                                                    }

													echo "<td><form action='sendupdatetext.php' method='post'><button type='submit' name='usersorderid' value='". $row2['id'] ."'>Update Status</button></form></td>";
                                                    
                                                    echo "<td><form action='completedelivery.php' method='post'><button type='submit' name='payorderid' value='". $row2['id'] ."'>Complete Delivery</button></form></td>";
													
												echo "</tr>";
                                            echo "</tbody>";
                                            }
										echo "</table>";
									echo"</div>";

							echo "</div>";
							echo "<div class='12u'>";
            echo "</section>";
         }
            ?>


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