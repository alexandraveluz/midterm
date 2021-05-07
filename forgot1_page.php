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
    height: 450px;
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
  height: 40px;
  margin-top: -80px;

}
h3{
  font-family: Arial;
}
</style>

<?php
 session_start();

include "connection.php";
date_default_timezone_set('Asia/Singapore');
$time=  date('Y-m-d H:i:s');

if (isset($_POST['submit'])){
  if (empty($_POST['setup1'])){
     echo"<script>alert('Please Enter Your Username')</script>";
  }

  elseif (isset($_POST['setup1'])){
        $username=$_POST['setup1'];
           $sql = "SELECT * FROM login_table WHERE username='$username' ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) === 1) {
                   $row = mysqli_fetch_assoc($result);
             if ($row['username'] === $username){

                      $_SESSION['username'] = $row['username'];
                      $_SESSION['id'] = $row['id'];
                       $user_id=$_SESSION['id'];
                      $username=$_SESSION['username'];
                      $activity="Attempt to Reset Password";

                      $insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 

                      header("Location:forgot2_page.php?username=$username");
            }//closing of if username equal
              
        }//num row closing
        else{
          echo"<script>alert('Username Does Not Exists')</script>";
        }

    }//closing of field isset
 
}//closing of submit button
 


?>

<body>
<form action="" method="POST" class="content">
<div class="background">

  <div class="header"><center><label for="password-input">&nbsp; &nbsp; &nbsp;STEP 1</label></center></div><br>
  <img src="pass.jpg" class="image">
    <center><h3>Enter Your Username</h3></center>
  
<br>
  <center><input type="text" name="setup1" class="email" ></center>
  


<button type="submit" class="submit_btn" name="submit">Submit</button>
</div>

</form>

</body>

</html>


