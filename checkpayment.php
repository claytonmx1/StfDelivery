<?php
session_start();
include_once 'dbh.inc.php';
if(!isset($_SESSION['u_id'])){
	header("Location: login.php");
}

$orderid = $_GET['referenceId'];

$payed = 'Payed';
$setstatus = 'Payment Completed, Waiting For Food...';

$sql1 = "UPDATE delivery SET hasbeenpayed='$payed' WHERE id='$orderid'";
		mysqli_query($conn, $sql1);


$sql2 = "UPDATE delivery SET status='$setstatus' WHERE id='$orderid'";
		mysqli_query($conn, $sql2);

        header("Location: accountdashboard.php");
		exit();

?>