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
		<style>
		#map {
			height: 500px;
			width: 700px;
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
						<h1>Delivery Address Radius Check</h1>
					</header>
					<h3 style="color: red;">* If you make an order and your delivery address is not in the radius. Your delivery fee will be refunded and your order will be canceled. You will be responsible for going to get your food.</h3>
					<div class="inner" id="map"></div>

				</div>
			</section>

			<!--script for map-->
			<script type="text/javascript">
			var geocoder;
			var address = "<?php echo $_POST['address'];?>"

			function initMap(){
				var location = {lat: 30.787, lng: -91.379};
				var map = new google.maps.Map(document.getElementById("map"),{
						zoom: 12,
						center: location,
						disableDefaultUI: true
				});	
				<?php
				if(!$_POST['address'] == ""){
				?>
				geocoder = new google.maps.Geocoder();
        		codeAddress(geocoder, map);
				

					<?php
				}
					?>

					  // Define the LatLng coordinates for the polygon's path.
  const triangleCoords = [
	{ lat: 30.783755, lng: -91.322513 },
	{ lat: 30.773653, lng: -91.327405 },
	{ lat: 30.772849, lng: -91.329303 },
	{ lat: 30.763261, lng: -91.332521 },
	{ lat: 30.761196, lng: -91.340675 },
	{ lat: 30.757424, lng: -91.340812 },
	{ lat: 30.751081, lng: -91.336349 },
	{ lat: 30.74636, lng: -91.3421 },
	{ lat: 30.773137,  lng: -91.392228 },
	{ lat: 30.797937, lng: -91.432515 },
	{ lat: 30.811944, lng: -91.422559 },
	{ lat: 30.830004, lng: -91.430021 },
	{ lat: 30.841421, lng: -91.435386 },
	{ lat: 30.852197, lng: -91.435217 },
	{ lat: 30.850797, lng: -91.402773 },
	{ lat: 30.848027, lng: -91.394539 },
	{ lat: 30.867111, lng: -91.396615 },
	{ lat: 30.873152,  lng: -91.386487 },
	{ lat: 30.901409, lng: -91.380589 },
	{ lat: 30.902588, lng: -91.36823 },
	{ lat: 30.889478, lng: -91.357415 },
	{ lat: 30.886089, lng: -91.3363 },
	{ lat: 30.847629, lng: -91.310879 },
	{ lat: 30.836276, lng: -91.298442 },
	{ lat: 30.822489, lng: -91.306413 },
	{ lat: 30.828754, lng: -91.321434 },
	{ lat: 30.805109, lng: -91.341411 },

	
  ];

  const triangletwo = [
	{ lat: 30.776175, lng: -91.325851 },
	{ lat: 30.786889, lng: -91.315699 },
	{ lat: 30.780916, lng: -91.28673 },
	{ lat: 30.759345, lng: -91.283898 },
	{ lat: 30.742748, lng: -91.292824 },
	{ lat: 30.747361, lng: -91.31355 },
	{ lat: 30.761376, lng: -91.316639 },
	{ lat: 30.767503, lng: -91.329862 },
	
  ];

  // Construct the polygon.
  const bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords,
    strokeColor: "#000000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#707070",
    fillOpacity: 0.35,
  });

  const bermudaTriangle2 = new google.maps.Polygon({
    paths: triangletwo,
    strokeColor: "#000000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#707070",
    fillOpacity: 0.35,
  });

  bermudaTriangle.setMap(map);
  bermudaTriangle2.setMap(map);
			}

<?php
if(!$_POST['address'] == ""){
?>
			      function codeAddress(geocoder, map) {
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });

		  } else {
            alert('We were not able to find your address because of: ' + status);
          }
        });
      }
			
<?php
}
?>
			</script>
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8uLjZR4Ju4gDXYYHbCT0pf6bQtjuOusg&callback=initMap" type="text/javascript"></script>

			<form name="form1" id="form1" method="POST">
										<div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
											<label for="name">Delivery Address -- Add "Saint Francisville" after your address. Without the quotes.</label>
												<input type="text" name="address" id="address" value="" placeholder="Address" />
											</div>
											<!-- Break -->
											<div class="12u$">
												<ul class="actions">
													<input type="submit" name="submit_address" value="Check Address">
												</ul>
											</div>
										</div>
									</form>

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