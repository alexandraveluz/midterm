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
	  height: 540px;
	  border-radius: 15px 15px 15px 15px;
}
.header{
	 background-color:#154360;
 border-style:ridge;
 border-color: gray;
 margin-left: -15px;
 margin-top: -7px;
 width: 537px;
 padding-top: 10px;
 padding-bottom: 10px;
 border-top-left-radius: 15px;
 border-top-right-radius: 15px;

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
  margin-top: 10px;
}.image{
	margin-left: 190px;
	height: 170px;
}
</style>



<body>
<?php
include 'connection.php';
session_start();
date_default_timezone_set('Asia/Singapore');
$time=  date('Y-m-d H:i:s');
if (isset($_POST['submit'])){
      if(!empty($_POST["otp"])) {
          $code =$_POST['otp'];
   
      $sql="SELECT * FROM otp_code ORDER BY ID DESC LIMIT 1"; 
                $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) === 1) {
                        $row = mysqli_fetch_assoc($result);
                         if ($row['code'] === $code && $row['created_at']) {
                                $_SESSION['code'] = $row['code'];
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['created_at'] = $row['created_at'];

                                $timestamp =  $_SERVER["REQUEST_TIME"];
                                $sqlQuery = "SELECT * FROM otp_code WHERE code='". $_POST["otp"]."' AND expiration!=1 AND NOW() <= DATE_ADD(created_at, INTERVAL 5 MINUTE)";

                                $result = mysqli_query($conn, $sqlQuery);
                                $count = mysqli_num_rows($result);
                                if (!empty($count)){
                                     $sql1="SELECT * FROM login_table ORDER BY id DESC LIMIT 1";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) === 1) {
                                        $row = mysqli_fetch_assoc($result1);
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['id'] = $row['id'];
                                        $user_id=$_GET['id'];
                                        $username=$_SESSION['username'];
                                        $activity="Login Successful";

                                        $insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 

                                    }
                                    header("Location: home.php?id=$user_id");
                                }
                                else{
                                    $sql1="SELECT * FROM login_table ORDER BY id DESC LIMIT 1";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) === 1) {
                                        $row = mysqli_fetch_assoc($result1);
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['id'] = $row['id'];
                                        $user_id=$_GET['id'];
                                        $username=$_SESSION['username'];
                                        $activity="Entered an expired code";

                                        $insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 

                                    }
                                  echo  "<script>alert('Your code is Already Expired! Please login again');location.href = 'login.php';</script>";


                                }
                         }//closing of equals condition
                         else{
                          $sql1="SELECT * FROM login_table ORDER BY id DESC LIMIT 1";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) === 1) {
                                        $row = mysqli_fetch_assoc($result1);
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['id'] = $row['id'];
                                        $user_id=$_GET['id'];
                                        $username=$_SESSION['username'];
                                        $activity="Invalid Code Entered";

                                        $insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 

                                    }
                          echo  "<script>alert('Invalid verification Code');</script>";
                         }
                  }//closing of num rows
             }// closing of if not empty
              if(empty($_POST["otp"])) {
                  echo  "<script>alert('Please enter verification code');</script>";
              }


}// closing of isset submit


?>
	
<form action="" method="POST" class="content">
<div class="background">
	<fieldset>
  <div class="header"><center><label for="password-input">&nbsp; &nbsp; &nbsp;Enter Verification Code</label></center></div><br>
  <img src="verify.png" class="image">
  	<center><h3>2 Way Step Verification</h3></center>
  	<center><h5 style="margin-top: -5px;">The page with verification code</h5></center>
  	<center><h5 style="margin-top: -15px;">was sent to <a href="http://localhost/midterm/otp_page.php" target="_blank">click here!</a></h5></center>
  <br><br>
  <div class="box"><input type="text" name="otp" id="password-input" inputmode="numeric" minlength="6" maxlength="6" size="9" value="" width="10px;"></div>
  <span class="hint">Code must be 6 digit number only</span>
</fieldset>

<button type="submit" class="submit_btn" name="submit">Submit</button>
</div>

</form>

</body>

</html>


