
<!DOCTYPE html>
<html>
<head>
  <title>LOGIN with OTP and EventLog/Audit Trial</title>
  <link href='https://fonts.googleapis.com/css?family=Archivo' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Archivo Black' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Sigmar One' rel='stylesheet'>
</head>
<style>
  * {
  margin: 0px;
  padding: 0px;
}

body {
   height: 100%;
    margin: 0;
  font-size: 120%;



 
  
 
}
label{
   font-family: 'Archivo';
   font-size: 18px;

}

form, .content {
  width: 32%;
  margin: 100px auto;
  padding: 20px;
  border: 1px ridge #B0C4DE;
   background-color:#58949C;

  border-radius: 10px 10px 10px 10px;
  
  height: 90%;
  margin-top: 40px;
  -webkit-box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);
-moz-box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);
box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);


}
.input-group {
  margin: 40px 10px 20px 10px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
  color: white;


}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border-width: : 1px;
  border-style: ridge;
  border-color:gray;

}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #154360;
  border-style:ridge;
  border-radius: 5px;
  width: 100%;
  font-family: 'Archivo';
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
  font-family: 'Bangers';
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
p{
  margin-top: 48px;
  margin-left: 15px;
    font-family: 'Archivo';
   font-size: 17px;
   color: white;

}
a{
  color: black;
   font-family: 'Archivo';
   font-size: 17px;
   color: white;

}
h2{
    font-family: 'Archivo';
   font-size: 32px;
   color: white;
   padding-top: 10px;
   padding-bottom: 10px;
   
}
.error{
  color:white;
  margin-top: 30px;
  background-color: #154360;
  border-style: none;
  text-align: center;
  margin-bottom: -30px;
  padding-bottom: 10px;
  font-family: 'Archivo';
  font-size: 18px;
  font-weight: bold;

}

.header{
  background-color:#154360;
  width: 427px;
  margin-left: -20px;
  margin-top: -20px;
 border-radius: 10px 10px 0px 0px;
 border-style:ridge;
 border-color: gray;



}
#field1{
  margin-top: 50px;
}
#field2{
  margin-top: 10px;
}
#errors {
  color:white;
  margin-top: 30px;
  background-color: #154360;
  border-style: none;
  text-align: center;
  margin-bottom: -30px;
  border-radius: 5px 5px 5px 5px;
  font-family: 'Arial';
  font-size: 15px;
  font-weight: bold;
  padding-top: 5px;


}
.forgot{
  margin-left: 220px;
  text-decoration: none;
  margin-top: 40px;
  padding-top: 10px;
}

</style>
<body>

<?php


?>
  <div class="division">

  <form method="post" action="login_function.php">

   <div class="header"><center><h2>Welcome</h2></center></div>
 
    <?php if(isset($_GET['error'])){?>
    <p class="error"><?php echo $_GET['error'];?></p>
  <?php } ?>
    <div class="input-group" id="field1">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group" id="field2">
  		<label>Password</label>
  		<input type="password" name="password">
       <a href="forgot1_page.php " class="forgot">Forgot Password?</a>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user" >L O G I N </button>
  	</div>
  	<p>

  	&nbsp;&nbsp;	Don't have an account? <a href="register.php ">Create An Account</a>
  	</p>

  </form>
</div>

</body>

</html>