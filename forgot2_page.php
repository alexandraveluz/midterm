<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<style>
  body{
  
  }
  fieldset {
  color: #555;
  font-family: sans-serif;
  border: none;
  position: relative;

  
}

fieldset > * {
  display: block;

}
form .content{

}

fieldset::after {
  content: "___  ___  ___  ___  ___  ___";
  display: block;
  position: absolute;
  top: 35px;
  white-space: pre;
  color: black;
  font-size: 30px;
  margin-left: 65px;
  margin-top: 353px;
 background-color:white;  

}

label {
  font-size: 24px;
  margin-bottom: 6px;
  color: white;
  margin-left: -10px;
  padding-top: 10px;
}

input#password-input {
  position: relative;
  font-size: 30px;
  z-index: 10;
  border: none;
  background: transparent;
  width: 490px;
  text-indent: 10px;
  letter-spacing: 48.6px;
  font-family:Arial;
  color: black;
  margin-left: 50px;
  margin-top: 8px;

}

input#password-input:focus {
  outline: none;
}

span.hint {
  margin-top: 5px;
  font-size: 12px;
  font-style: italic;
  color: black;
  margin-left: 20px;
}

span.hint::before {
  content: "* ";
  color:black;
}
.background{
    background-color: white;  
    border-style:ridge;
    width: 540px;
    margin-top: 40px;
    margin-left: 350px;
    height: 600px;
    border-radius: 15px 15px 15px 15px;
}
.header{
   background-color:#154360;
 border-style:ridge;
 border-color: gray;
 margin-left: -1px;
 margin-top: -1px;
 width: 538px;
 padding-top: 10px;
 padding-bottom: 10px;
 border-top-left-radius: 15px;
 border-top-right-radius: 15px;
 font-family: arial;

}
.box{
  background-color:white; 
  height: 70px;
  margin-left: 20px;
  width: 480px;
  border-style: ridge;
  margin-top: -30px;

}
.submit_btn{
      padding: 10px;
  font-size: 15px;
  color: white;
  background: #154360;
  border-style:ridge;
  border-radius: 5px;
  width: 35%;
  font-family: 'arial';
  margin-left: 180px;
  margin-top: 20px;
}.image{
  margin-left: 190px;
  height: 170px;
}
.email{
  width: 300px;
  height: 30px;
  margin-top: -80px;

}
h4{
  font-family: Arial;
}
</style>
<?php
session_start();
date_default_timezone_set('Asia/Singapore');
$time=  date('Y-m-d H:i:s');
include "connection.php";

$username = $_REQUEST['username'];

if (isset($_POST['submit'])){
	$last=$_POST['pass1'];
	$new=$_POST['pass2'];
	$confirm=$_POST['pass3'];

		if (isset($_GET['username'])){
				if (empty($last) || empty($new)|| empty($confirm)) {
				echo "<script>alert('Please fill all fields')</script>";
				}//closing of emplty field check
				elseif ($new!=$confirm) {
				echo "<script>alert('Password Does not Match')</script>";
				}
				elseif (!empty($confirm) && $new===$confirm) {
							 $uppercase = preg_match('@[A-Z]@', $confirm);
							  $lowercase = preg_match('@[a-z]@', $confirm);
							  $number    = preg_match('@[0-9]@', $confirm);
							  $specialChars = preg_match('@[^\w]@', $confirm);
              				  	
							  	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($confirm) < 8) {
    								echo "<script>alert('Password should be at least 8 characters in length and atleast one uppercase and lowercase letter, one number, and special character ')</script>";
								}else{
									$sql = "SELECT * FROM login_table WHERE username = '$username'";
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result) === 1) {
											$row = mysqli_fetch_assoc($result);
									  $_SESSION['username'] = $row['username'];
		             				  $_SESSION['id'] = $row['id'];
		              				  $username1 = $_REQUEST['username'];
										$password=md5($confirm);
		              				  	$sql="UPDATE login_table SET password='" . $password . "'  WHERE username = '"  . $username . "'";
              				  	
              				  	$result=mysqli_query($conn, $sql);
              				   	

              				   		$_SESSION['username'] = $row['username'];
                      				$_SESSION['id'] = $row['id'];
                       				$user_id=$_SESSION['id'];
                      				$username=$_SESSION['username'];
                      				$activity="Password Has Been Changed";

                      				$insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 
              				 
              				   echo "<script>alert('Password has been Changed'); window.location = 'login.php';</script>";
              				   	}
						}//closing of num row
								
				}


		}//closing of get username

}//clossing of issent submit


?>

<body>
<form action="" method="POST" class="content">
<div class="background">

  <div class="header"><center><label for="password-input">&nbsp; &nbsp; &nbsp;STEP 2</label></center></div><br>
  <img src="pass.jpg" class="image">
    <center><h4>Last Remembered Password</h4></center>
  <center><input type="text" name="pass1" class="email" ></center>
   <center><h4>New Password</h4></center>
  <center><input type="password" name="pass2" class="email" ></center>
   <center><h4>Confirm Password</h4></center>
  <center><input type="password" name="pass3" class="email" ></center>
  


<button type="submit" class="submit_btn" name="submit">Submit</button>
</div>

</form>

</body>

</html>

