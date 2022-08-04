<?php
session_start();
include 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}

//end of connection
$orderid = $_POST['usersorderid'];
$status = "Your Food Is On The Way!";

$sql1 = "UPDATE delivery SET status='$status' WHERE id='$orderid'";
		mysqli_query($conn, $sql1);

		header("Location: admin.php");

?>