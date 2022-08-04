<?php
    include('dbh.inc.php');
session_start();
if(!isset($_SESSION['u_id'])){
	header("Location: login.php");
}


$username = $_SESSION['u_id'];
$order_id = $_POST['payorderid'];


$sql1 = "SELECT * FROM delivery WHERE id='$order_id'";
$result = mysqli_query($conn, $sql1);

if($row = mysqli_fetch_assoc($result)) {
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $phonenumber = $row['phonenumber'];
    $deliveryaddress = $row['deliveryaddress'];
    $paytype = $row['paytype'];
    $instructions = $row['instructions'];
    $orderlocation = $row['orderlocation'];
    $username = $row['username'];
    $status = $row['status'];
    $ordername = $row['ordername'];
    $discountcheck = $row['cost'];

    if($discountcheck < 1000){
        $discountused = "YES";
    }else{
        $discountused = "NO";
    }

}


$sql2 = "INSERT INTO canceledorderhistory (firstname, lastname, phonenumber, deliveryaddress, paytype, instructions, orderlocation, username, status, ordername, orderid, discount, cost) VALUES ('$firstname', '$lastname', '$phonenumber', '$deliveryaddress', '$paytype', '$instructions', '$orderlocation', '$username', '$status', '$ordername', '$order_id', '$discountused', '$discountcheck');";
					mysqli_query($conn, $sql2);


$sql3 = "DELETE from delivery WHERE id='$order_id' ";
$r = mysqli_query($conn, $sql3);
				header("Location: accountdashboard.php");
					exit();

?>