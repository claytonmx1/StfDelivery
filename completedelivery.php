<?php
session_start();
include_once 'dbh.inc.php';
date_default_timezone_set('America/Chicago');

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}


$orderid = mysqli_real_escape_string($conn, $_POST['payorderid']);
$payed = 'Payed';



$sql = "SELECT * FROM delivery WHERE id='$orderid'";
$result = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($result)) {
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $phonenumber = $row['phonenumber'];
    $deliveryaddress = $row['deliveryaddress'];
    $paytype = $row['paytype'];
    $instructions = $row['instructions'];
    $orderlocation = $row['orderlocation'];
    $username = $row['username'];
    $status = 'Delivery Completed';
    $ordername = $row['ordername'];
    $started_time = $row['time'];
    $completed_time = date('h:i:s');
    $discountcheck = $row['cost'];

    if($discountcheck < 1000){
        $discountused = "YES";
    }else{
        $discountused = "NO";
    }
}


$sql1 = "INSERT INTO completedorderhistory (firstname, lastname, phonenumber, deliveryaddress, paytype, instructions, orderlocation, username, status, ordername, orderid, madetime, completedtime, discount, price) VALUES ('$firstname', '$lastname', '$phonenumber', '$deliveryaddress', '$paytype', '$instructions', '$orderlocation', '$username', '$status', '$ordername', '$orderid', '$started_time', '$completed_time', '$discountused', '$discountcheck');";
					mysqli_query($conn, $sql1);


$sql2 = "DELETE from delivery WHERE id='$orderid' ";
$r = mysqli_query($conn, $sql2);
				header("Location: admin.php");
					exit();


?>