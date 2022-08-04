<?php
session_start();
if(isset($_SESSION['u_id'])){
	header("Location: index.php");
}
if(isset($_POST['submit'])){

    include_once 'dbh.inc.php';

	
	$first = mysqli_real_escape_string($conn, $_POST['firstname']);
	$last = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$userlevel = "1";
	//error handlers

		//Disabled For Now...doesn't work Up On Droids
		//check if their trying to flood our db with shit
		//if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
				//echo '<script language="javascript" type="text/javascript"> 
               // alert("Invalid Characters In First Or Last Name");
               // window.location = "register.html";
				//</script>';
	//exit();
		//}else{
			//check to make sure valid email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<script language="javascript" type="text/javascript"> 
                alert("Invalid Email");
                window.location = "register.php";
				</script>';
					exit();
			}else{
				$sql = "SELECT * FROM users WHERE username='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck > 0) {
				echo '<script language="javascript" type="text/javascript"> 
                alert("Username Already Taken");
                window.location = "register.php";
				</script>';
						exit();
				} else {
					//Hash the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Inserting the user into the database
					$sql2 = "INSERT INTO users (username, password, firstname, lastname, email, phone, userlevel) VALUES ('$uid', '$hashedPwd', '$first', '$last', '$email', '$phone', '$userlevel');";
					mysqli_query($conn, $sql2);
					echo '<script language="javascript" type="text/javascript"> 
                alert("Account Created, Welcome To StfDelivery!");
                window.location = "index.php";
				</script>';
					exit();
				}
			}
			


}else{
    header("Location: register.php");
	exit();
}

?>