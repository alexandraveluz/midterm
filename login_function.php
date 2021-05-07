<?php 
session_start(); 
include "connection.php";
date_default_timezone_set('Asia/Singapore');
$time=date('Y-m-d H:i:s');
if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username']);
	$password = validate($_POST['password']);
	$pass=md5($password);

	if (empty($uname)) {
		header("Location: login.php?error=Username is Required");
	    exit();
	}else if(empty($password)){
        header("Location:login.php?error=Password is Required");
	    exit();
	}else{
		$sql = "SELECT * FROM login_table WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $username=$row['username'];
                $_SESSION['id'] = $row['id'];
       			$user_id=$_SESSION['id'];
                $activity="Login Attempt";
                $insert=mysqli_query($conn, "INSERT into audit_trial(user_id, date_and_time, username, activity)
                	values('$user_id', '$time', '$username', '$activity')");
				
				
                $otp = rand(100000,999999);
                $expiration = date('Y-m-d H:i:s', strtotime("+5 min"));
            	$result1 = "INSERT INTO otp_code(user_id, code, created_at, expiration, username) VALUES ('$user_id', '$otp', '$time','$expiration', '$username')";
            	if (mysqli_query($conn, $result1)) {
				header("Location: modal.php?id=$user_id");	 
					}else{}
				}
			else if ($row['username'] != $uname || $row['password'] != $pass) {
					header("Location:login.php?error=Incorrect Username or Password");
            }else{
				header("Location: login.php?error=User Does Not Exists");
		        exit();
			}
		}else{
			header("Location:login.php?error=Incorrect Username or Password");
	        exit();
		}
	}
	}else{
	header("Location: login.php");
	exit();
}
?>

