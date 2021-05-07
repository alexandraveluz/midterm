
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
  background-color:white;
   background-repeat:repeat;
 
  
 
}
label{
   font-family: 'Archivo';
   font-size: 18px;

}

form, .content {
  width: 34%;
  margin: 100px auto;
  padding: 20px;
  border: 1px ridge #B0C4DE;
   background-color:#58949C;
 -webkit-box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);
-moz-box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);
box-shadow: 0px 0px 15px 3px rgba(148,148,148,1);

  border-radius: 10px 10px 10px 10px;
  
  height: 90%;
  margin-top: 30px;




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

p{
  margin-top: 48px;
  margin-left: 15px;
    font-family: 'Archivo';
   font-size: 17px;
   color: white;

}
a{
  color: black;
   font-family: 'Arial';
   font-weight: bold;
  text-decoration: none;
   color: white;
   font-size: 15px;
   

}
h2{
    font-family: 'Archivo';
   font-size: 32px;
   color: white;
   padding-top: 10px;
   padding-bottom: 10px;

   
}
span{
  font-family: arial;
  text-align: center;
  color: white;
  font-size: 15px;
}
.errors{
  color:white;
  margin-top: -120px;
 background-color:#154360;
  border-style: none;
  text-align: center;
  margin-bottom: -30px;
  border-radius: 5px 5px 5px 5px;
  font-family: 'Arial';
  font-size: 15px;
  font-weight: bold;
  width: 390px;
  margin-left: 420px;



}
.division{
  margin-top: 0px;

  width: 1300px;

 border-style: ridge;
}
.header{
  background-color:#154360;
  width: 455px;
  margin-left: -22px;
  margin-top: -20px;
 border-radius: 10px 10px 0px 0px;
 border-style:ridge;
 border-color: gray;



}
#field1{
  margin-top:30px;
}
#field2{
  margin-top: 10px;
}
#field3{
  margin-top: 0px;
}
#field4{
  margin-top: 0px;
}

</style>
<body>

<?php
include 'connection.php';
session_start();
date_default_timezone_set('Asia/Singapore');
$time=date('Y-m-d H:i:s');
$error1=''; $error2=''; $error3=''; $error4=''; $error5=''; $error6='';$error7=''; $error8=''; $error9=''; 
$count='';

if (isset($_POST['register_user'])){
  $username = $_POST['username'];
  $email=$_POST['email'];
  $password = $_POST['password'];
  $pass_final = $_POST['confirm_password'];

  if (!empty($password) && !empty($pass_final)){
    if ($password != $pass_final){
              $error1='Password Does Not Match'; 
              $count=1;
               
                
         }else{}   
             if (strlen($pass_final) <= '8') {
              $error2='Password Must Contain Atleast 8 Digits';
               $count=1;
               
                
               
         }else{}       
              if(!preg_match("#[0-9]+#",$pass_final)) {
               $error3='Password Must Contain Atleast 1 Number';
                $count=1;
                  
               
          }else{}
              if(!preg_match("#[A-Z]+#",$pass_final)) {
                 $error4='Password Must Contain Atleast 1 Uppercase Letter';
                  $count=1;
                    
                    
          }else{}
               if(!preg_match("#[a-z]+#",$pass_final)) {
                    $error5='Password Must Contain Atleast 1 Lowercase Letter';
                     $count=1;
                    
                      
         }else{}
               if(!preg_match("@[^\w]@", $pass_final)) {
                  $error6='Password Must Contain Atleast Special Character';
                    $count=1;
                    
         }else{}
          if(empty($email) && empty($password) && empty($pass_final) && empty($username)) {
                  $error7='Please Fill all the Fields';
                   $count=1;
                   
                    
         }else{}
  }
        
   $sql = mysqli_query($conn, "SELECT * FROM login_table WHERE email = '$email' or username='$username'");

    if(mysqli_num_rows($sql)>0){
      $row = mysqli_fetch_assoc($sql);
          if($email==isset($row['email'])) {
          $error8='Email Already Exist';
           $count=1;
   
        }else{}
          if($username==isset($row['username'])) {
            $error9='Username Already Exists';
             $count=1;
         
         }else{}
             

      }//closing of num rows
            if ($count<1){
              $encrypt=md5($password);
                 $query1 = mysqli_query($conn, "INSERT INTO login_table(username, password, email) VALUES('$username','$encrypt','$email')");
                if($query1){
                   $last_id = mysqli_insert_id($conn);
                   echo "<script>alert('You have Successfully Registered');location.href = 'login.php';</script>";
                   
                    $sql = mysqli_query($conn, "SELECT * FROM login_table WHERE id= '$last_id'");
                      if(mysqli_num_rows($sql)>0){
                           $row = mysqli_fetch_assoc($sql);
                           $username=$row['username'];
                           $activity="Registered An Account Successfully";

                        $insert=mysqli_query($conn, "INSERT into audit_trial(user_id, date_and_time, username, activity)values('$last_id', '$time', '$username', '$activity')");
                      }//query closing
            }//num rows closing
          }//counnt button closing
  }//closj gof register button



?> 


  <form method="post" action="">
   <div class="header"><center><h2>Create An Account</h2></center></div><br>
      <div class="notif" style=" background-color:#154360;">
        <center>        <span><?php if (!empty($error1)){echo $error1;echo "<br>";}?></span>
         <span><?php if (!empty($error2)){echo $error2;echo "<br>";}?></span>
         <span><?php if (!empty($error3)){echo $error3;echo "<br>";}?></span>
         <span><?php if (!empty($error4)){echo $error4;echo "<br>";}?></span>
        <span><?php if (!empty($error5)){echo $error5;echo "<br>";}?></span>
         <span><?php if (!empty($error6)){echo $error6;echo "<br>";}?></span>
         <span><?php if (!empty($error7)){echo $error7;echo "<br>";}?></span>
        <span><?php if (!empty($error8)){echo $error8;echo "<br>";}?></span>
          <span><?php if (!empty($error9)){echo $error9 ;echo "<br>";}?></span>
      </div>
    <div class="input-group" id="field1">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
    <div class="input-group" id="field2">
    
      <label>Email</label>
      <input type="email" name="email" required>
    </div>
  	<div class="input-group" id="field3">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
      <div class="input-group" id="field4">
      <label>Confirm Password</label>
      <input type="password" name="confirm_password">
    </div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="register_user">Signup </button>
  	</div>

    <center><span id="already">Have already an account?</span><a href="login.php">Login Here</a></center>
  	
  
  </form>
  
</div>

</body>


</html>
