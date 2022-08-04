<?php
session_start();

if(isset($_SESSION['u_id'])){
	header("Location: index.php");
}

if (isset($_POST['submit'])) {
		include 'dbh.inc.php';
		
		$uid = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['password']);
		
		//error handlers
		//check if inputs empty
		if(empty($uid) || empty($pwd)){
			
					header("Location: login.php");
					exit();
			
		} else {
			$sql = "SELECT * FROM users WHERE username='$uid'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if ($resultCheck < 1) {
				  echo '<script language="javascript" type="text/javascript"> 
                alert("User Doesnt Exist");
                window.location = "login.php";
				</script>';
					exit();
			} else {
				if($row = mysqli_fetch_assoc($result)) {
					//Unhashing
					$hashedPwdCheck = password_verify($pwd, $row['password']);
					if($hashedPwdCheck == false) {
							echo '<script language="javascript" type="text/javascript"> 
							alert("Wrong Password");
							window.location = "login.php";
							</script>';
					exit();
							exit();
					}elseif ($hashedPwdCheck == true) {
						//logging in
						$_SESSION['u_id'] = $row['username'];
						$_SESSION['u_first'] = $row['firstname'];
						$_SESSION['u_last'] = $row['lastname'];
                        $_SESSION['u_email'] = $row['email'];
                        $_SESSION['u_userlevel'] = $row['userlevel'];
						
							header("Location: index.php");
							exit();
					}
					
				}
			}
		}
	
	
} else {
	header("Location: login.php");
	exit();
}