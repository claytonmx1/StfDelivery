<?php
session_start();
include 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}

$code = $_POST['createdcode'];
$price = $_POST['createdprice'];

$sql2 = "INSERT INTO discountcodes (couponcode, newprice) VALUES ('$code', $price);";
					mysqli_query($conn, $sql2);
                    header("Location: adminpanel.php");


?>