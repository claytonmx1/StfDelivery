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





        <style>
		table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}


		</style>









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
						<h1>Admin Canceled Orders</h1>
						<p></p>
					</header>
			</section>

            <?php if (isset($_SESSION['u_id'])) {
		date_default_timezone_set('America/Chicago');
		$userid = $_SESSION['u_id'];
        ?>
         


<table>
		<thead>
		<tr>
        <th scope="col">ID</th>
		<th scope="col">Order ID</th>
		<th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Delivery Address</th>
		<th scope="col">PayType</th>
        <th scope="col">Instructions</th>
        <th scope="col">Order Location</th>
        <th scope="col">Username</th>
        <th scope="col">Status</th>
        <th scope="col">Order Name</th>
        <th scope="col">Discount Used</th>
        <th scope="col">Price</th>

		</tr>
		</thead>
		<tbody>
<?php
        if($user_info = mysqli_query($conn,"SELECT * FROM canceledorderhistory"))
{
  while ($row6 = mysqli_fetch_array($user_info))    
  {
?>
        
		<tr>
        	<td scope="row" data-label="ID"><?php echo $row6['id'] ?></td>
			<td data-label="Order ID"><?php echo $row6['orderid'] ?></td>
			<td data-label="FirstName"><?php echo $row6['firstname'] ?></td>
			<td data-label="LastName"><?php echo $row6['lastname'] ?></td>
			<td data-label="PhoneNumber"><?php echo $row6['phonenumber'] ?></td>
			<td data-label="Delivery Address"><?php echo $row6['deliveryaddress'] ?></td>
            <td data-label="PayType"><?php echo $row6['paytype'] ?></td>
            <td data-label="Instructions"><?php echo $row6['instructions'] ?></td>
            <td data-label="Order Location"><?php echo $row6['orderlocation'] ?></td>
            <td data-label="Username"><?php echo $row6['username'] ?></td>
            <td data-label="Status"><?php echo $row6['status'] ?></td>
            <td data-label="Order Name"><?php echo $row6['ordername'] ?></td>
            <td data-label="Discount Used"><?php echo $row6['discount'] ?></td>
            <td data-label="Price"><?php echo $row6['cost'] ?></td>
		</tr>
<?php
}}}
?>
		</tbody>
	</table>





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