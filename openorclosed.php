<?php
session_start();
include 'dbh.inc.php';

if($_SESSION['u_userlevel'] != 2){
	header("Location: index.php");
}

$store = $_POST['openorclosed'];

if($store == 'open'){

    $sql1 = "UPDATE areweopen SET store='$store'";
    mysqli_query($conn, $sql1);
    header("Location: generic.php");
        exit();

}elseif($store == 'closed'){

    $sql2 = "UPDATE areweopen SET store='$store'";
    mysqli_query($conn, $sql2);
    header("Location: generic.php");
        exit();

}



?>