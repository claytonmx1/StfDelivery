<?php
session_start();
include_once 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}


$orderid = mysqli_real_escape_string($conn, $_POST['payorderid']);
$payed = 'Payed';
$setstatus = 'Payment Completed, Waiting For Food...';

$sql1 = "UPDATE delivery SET hasbeenpayed='$payed' WHERE id='$orderid'";
		mysqli_query($conn, $sql1);


$sql2 = "UPDATE delivery SET status='$setstatus' WHERE id='$orderid'";
		mysqli_query($conn, $sql2);

        header("Location: admin.php");
		exit();


?>