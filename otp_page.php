<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=JetBrains Mono' rel='stylesheet'>
</head>
<style type="text/css">
	.code{
		color: red;
		font-size: 30px;
		font-family: 'JetBrains Mono';
	}
	h1{
		margin-top: 60px;
		font-family: 'Arial';
	}
	.expire{
		font-size: 20px;
		font-family: 'Arial';
	}
</style>
<body>
<form action="" method="POST">
		<center><h1>YOUR ONE TIME PASSWORD</h1></center>
</form>


	<?php
	session_start();
	include 'connection.php';
	
		$sql="SELECT * FROM otp_code ORDER BY ID DESC LIMIT 1";	
			$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) === 1) {
									$row = mysqli_fetch_assoc($result);
           							 if ($row['code']&& $row['expiration']) {
           							 	$_SESSION['code'] = $row['code'];
            								$_SESSION['id'] = $row['id'];
            								$_SESSION['code'] = $row['code'];
            								$_SESSION['expiration'] = $row['expiration'];

            								$code1=$_SESSION['code'];
            								$expiration=$_SESSION['expiration'];
            								echo "<center><label class='code'>$code1</label></center><br>";
            								echo "<center><label class='expire'>This OTP will Expire In:</label></center>"  ;
            								echo "<center><label class='expire'>$expiration</label></center><br>";
           							 }
								}

								 


	?>

</body>
</html>