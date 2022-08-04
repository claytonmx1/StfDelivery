<?php
session_start();
include 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}

$code = $_POST['couponname'];

$sql2 = "DELETE from discountcodes WHERE couponcode='$code' ";
$r = mysqli_query($conn, $sql2);
				header("Location: adminpanel.php");
					exit();


?>