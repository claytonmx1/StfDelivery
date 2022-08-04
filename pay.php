<?php
//Square API help from LA-RV.com :)

session_start();
include_once 'dbh.inc.php';
if(!isset($_SESSION['u_id'])){
	header("Location: login.php");
}


$id = $_SESSION['u_id'];
$orderid = mysqli_real_escape_string($conn, $_POST['payorderid']);

$sql8 = "SELECT * FROM delivery WHERE id='$orderid'";
                $result8 = mysqli_query($conn, $sql8);
                $fetch5 = mysqli_fetch_assoc($result8);
                $cost = intval($fetch5['cost']);



$result = mysqli_query($conn, "SELECT * FROM delivery WHERE id = '" . $orderid. "'");
if ($row = mysqli_fetch_array($result)) {
		$customerFirstName = $row['firstname'];
        $customerLastName = $row['lastname'];
		$customerPhone = $row['phonenumber'];
	}

    $result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $id. "'");
    if ($row2 = mysqli_fetch_array($result2)) {
            $customerEmail = $row2['email'];
        }
	
// ******  START BUILDING THE SQUARE DATA  ******

// Include the Square Connect API resources
require_once(__DIR__ . '/connect-php-sdk-master/autoload.php');

//Replace your access token and location ID
$accessToken = '';  
$locationId = '';

// Create and configure a new API client object
$defaultApiConfig = new \SquareConnect\Configuration();
$defaultApiConfig->setAccessToken($accessToken);
$defaultApiClient = new \SquareConnect\ApiClient($defaultApiConfig);
$checkoutClient = new SquareConnect\Api\CheckoutApi($defaultApiClient);
$address = new \SquareConnect\Model\Address;

//Create a Money object to represent the price of the line item.
$price = new \SquareConnect\Model\Money;
$price->setAmount($cost);
$price->setCurrency('USD');

//Create the line item and set details
$rent = new \SquareConnect\Model\CreateOrderRequestLineItem;
$rent->setName('StfDelivery OrderID - ' . $orderid . '');
$rent->setQuantity('1');
$rent->setBasePriceMoney($price);
$rent->setNote($customerFirstName . ' | ' .  $customerLastName . ' | ' . $customerPhone);

//Puts our line item object in an array called lineItems.
$lineItems = array();
array_push($lineItems, $rent);

// Create an Order object using line items from above
$order = new \SquareConnect\Model\CreateOrderRequest();

$order->setIdempotencyKey(uniqid()); //uniqid() generates a random string.
$order->setReferenceId($orderid);
//sets the lineItems array in the order object
$order->setLineItems($lineItems);

$checkout = new \SquareConnect\Model\CreateCheckoutRequest();

$checkout->setIdempotencyKey(uniqid()); //uniqid() generates a random string.
$checkout->setOrder($order); //this is the order we created in the previous step
$checkout->setPrePopulateBuyerEmail($customerEmail);
$checkout->setRedirectUrl('http://stfdelivery.com/checkpayment.php');
//$checkout->setAskForShippingAddress(true);
//$checkout->setPrePopulateShippingAddress($address);

try {
    $result = $checkoutClient->createCheckout(
      $locationId,
      $checkout
    );
    //Save the checkout ID for verifying transactions
    $checkoutId = $result->getCheckout()->getId();
    //Get the checkout URL that opens the checkout page.
    $checkoutUrl = $result->getCheckout()->getCheckoutPageUrl();
//    print_r('Complete your transaction: ' + $checkoutUrl);
//	echo "<a href='$checkoutUrl'>";
//	echo "Click to complete transaction </a>";
} catch (Exception $e) {
    echo 'Exception when calling CheckoutApi->createCheckout: ', $e->getMessage(), PHP_EOL;
}

if ($e == 0)
	{
?>

	
	


<!DOCTYPE HTML>
<!--
    Template Used Below, Re Coded By ClaytonMx 
	templated.co @templatedco
-->
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
					<?php if (isset($_SESSION['u_id'])) { echo '<li><a href="logout.php">Logout</a></li>';} ?>
				</ul>
				<ul class="actions vertical">
					<!-- no login for now <a href="#" class="button alt">Log in</a> -->
				</ul>
			</nav>
			<script>
			function checkform() {
				if(document.form1.firstname.value == "" || document.form1.lastname.value == "" || document.form1.phone.value == "" || document.form1.email.value == "") {
					alert("One Or More Fields Are Empty...");
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
						<h1>Delivery Payment</h1>
						<p></p>
					</header>
					<!--<div class="image fit">
						<img src="images/saintfranhouse.jpg" alt="" />
                    </div>  no image for our delivery form-->
										<div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                            <label for="name">FirstName</label>
												<input type="text" name="firstname" id="firstname" value="<?php echo $customerFirstName; ?>" placeholder="Firstname" readonly />
											</div>
                                            <div class="6u 12u$(xsmall)">
                                            <label for="name">LastName</label>
												<input type="text" name="lastname" id="lastname" value="<?php echo $customerLastName; ?>" placeholder="Lastname" readonly />
											</div>
                                            <div class="6u 12u$(xsmall)">
                                            <label for="name">PhoneNumber</label>
												<input type="text" name="phone" id="phone" value="<?php echo $customerPhone; ?>" placeholder="PhoneNumber" readonly />
											</div>
                                            <div class="6u 12u$(xsmall)">
                                            <label for="name">Email</label>
												<input type="text" name="email" id="email" value="<?php echo $customerEmail; ?>" placeholder="Email" readonly />
											</div>
											<!-- Break -->
											<!-- Break -->
											<!-- Break -->
											<div class="12u$">
												<ul class="actions">
													<li><button onClick="location.href='<?php echo $checkoutUrl; ?>'" type="submit" name="submit" onclick="return checkform()">Pay At Square</button></li>
												</ul>
											</div>
										</div>
					
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
<?php
	}
?>
