<?php
include('dbh.inc.php');
session_start();
if(!isset($_SESSION['u_id'])){
	header("Location: login.php");
}

if (isset($_POST['submit'])) {

date_default_timezone_set('America/Chicago');

$username = $_SESSION['u_id'];
$first_name = $_SESSION['u_first'];
$order_name = $_POST['ordername'];
$last_name = $_SESSION['u_last'];
$delivery_address = $_POST['address'];
$phone_number = $_POST['phone'];
$payment_option = $_POST['category'];
$delivery_instructions = $_POST['instructions'];
$order_location = $_POST['orderlocation'];
$entereddiscountcode = $_POST['discountcode'];
$cost = 1000;
$cooktime = strtotime('+20 minutes');
$current_time = date('h:i:s');
$newpickuptime = date('h:i:s', $cooktime);

if($payment_option == '1'){
    $payment_type = 'Cash';
    $status = 'Waiting For Food...';
}else{
    $payment_type = 'Card';
    $status = 'Waiting For Payment...';
}
if($delivery_instructions == "" || $delivery_instructions == null){
    $delivery_instructions = "None";
}

//discount stuff
if($entereddiscountcode != "" || $entereddiscountcode != null){


$sql7 = "SELECT * FROM discountcodes WHERE couponcode='$entereddiscountcode'";
			$result7 = mysqli_query($conn, $sql7);
			$resultCheck = mysqli_num_rows($result7);
			
			if ($resultCheck < 1) {
                $cost = 1000;
                echo "<script>
                alert('Invalid Discount Code Entered');
                window.location.href='generic.php';
                </script>";
            }else if($resultCheck > 0){
                $sql8 = "SELECT * FROM discountcodes WHERE couponcode='$entereddiscountcode'";
                $result8 = mysqli_query($conn, $sql8);
                $fetch = mysqli_fetch_assoc($result8);
                $cost = $fetch['newprice'];

                $sql = "INSERT INTO delivery (firstname, lastname, deliveryaddress, instructions, paytype, phonenumber, orderlocation, username, status, ordername, time, pickuptime, cost) VALUES ('$first_name', '$last_name', '$delivery_address', '$delivery_instructions', '$payment_type', '$phone_number', '$order_location', '$username', '$status', '$order_name', '$current_time', '$newpickuptime', '$cost');";
				mysqli_query($conn, $sql);

                $sql27 = "DELETE from discountcodes WHERE couponcode='$entereddiscountcode' ";
                $r = mysqli_query($conn, $sql27);

				header("Location: accountdashboard.php");
					exit();
            }
            
        }
    
//end of discount

if($entereddiscountcode == "" || $entereddiscountcode == null){

    $sql = "INSERT INTO delivery (firstname, lastname, deliveryaddress, instructions, paytype, phonenumber, orderlocation, username, status, ordername, time, pickuptime, cost) VALUES ('$first_name', '$last_name', '$delivery_address', '$delivery_instructions', '$payment_type', '$phone_number', '$order_location', '$username', '$status', '$order_name', '$current_time', '$newpickuptime', '$cost');";
				mysqli_query($conn, $sql);
				
                header("Location: accountdashboard.php");
					exit();
}
}else{
    header("Location: generic.php");
	exit();
}
?>
