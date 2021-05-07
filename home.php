<?php 
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Singapore');
$time=  date('Y-m-d H:i:s');
$user_id = $_REQUEST['id'];
$username='';

if (isset($_GET['id'])){

  $sql = "SELECT * FROM login_table WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1) {
              $row = mysqli_fetch_assoc($result);
               $_SESSION['username'] = $row['username'];
               $username=$_SESSION['username'];

    }//closing of num rows
}//closing of isset id

if (isset($_POST['logout'])){
     $sql1="SELECT * FROM login_table where id=$user_id";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) === 1) {
                                        $row = mysqli_fetch_assoc($result1);
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['id'] = $row['id'];
                                        $user_id=$_GET['id'];
                                        $username=$_SESSION['username'];
                                        $activity="Logout";

                                        $insert=mysqli_query($conn, "INSERT into audit_trial (user_id, username, activity, date_and_time)
                                        values('$user_id', '$username', '$activity', '$time')"); 
                        header("Location: login.php");
 
 
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		 * {
  margin: 0px;
  padding: 0px;
}
body {

  background: #F8F8FF;
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkzzzOzTydIRDk6qm8byWmEDrZOiJZdWWfpA&usqp=CAU');
 font-family: 'Arial';
 font-size: 24px;
}
.div{

margin-top: 30px;
}
button{
width: 100px;
height: 35px;
margin-top: 30px;
background-color: black;

}
.name{
	color: white;
}	
p{
  margin-top: 50px;
      font-family: 'Archivo';
   font-size: 18px;
   text-align: center;  
   text-decoration: none;

}
.view{
  text-decoration: none;
  color: white;
  background-color: black;
  font-size: 20px;
  padding-right: 10px;
  border-radius: 10px 10px 10px 10px;
  width: 300px;
  height: 50px;
}

button{
width: 100px;
height: 35px;
margin-top: 30px;
background-color: black;

}
.name{
  color: white;
} 
p{
  margin-top: 50px;
      font-family: 'Archivo';
   font-size: 18px;
   text-align: center;  
   text-decoration: none;

}
a{
  text-decoration: none;
  color: white;
  background-color: black;
  font-size: 20px;
  padding-bottom: 10px;
  padding-top: 10px;
  padding-left: 10px;
  padding-right: 10px;
  border-radius: 10px 10px 10px 10px;
}

</style>
</head>
<body>
	<form action="" method="POST">
	<div class="div">
    <center> <h1>WELCOME <br> <?php echo $username; ?></h1></center>
     <center><button type="submit" name="logout" ><h3 class="name">Logout</h3></button></center>
     <p>
       <button type="submit" class="view" name="show" onclick="document.getElementById('java').style.display='block'" class="w3-button w3-black">View Event Log/Audit Trial </button>
    </p>
     </div>
    </form>
    <br>
   <center> <div class="divs" id="java">
      <?php
      if (isset($_POST['show'])){
         echo" <div class='containter'>
    <h2> Audit Trial/Event Log</h2>
    
    <table class='table table-botdered table-hover'  border='1px;'>
      <thead>
        <tr>
          <th style='width:290px;height:40px;text-align:center; font-family:Arial;'>Activity</th>
          <th style='width:290px;height:40px;text-align:center; font-family:Arial;'>date_and_time</th>
        </tr>

      </thead>
    </tbody>
  </div>";


        $sql= "SELECT `user_id`,`username`, `activity`, `date_and_time`from audit_trial where user_id=$user_id";
        $result= $conn->query($sql);
        echo "<label>User ID: </label>". $user_id;
          echo "<br>";
          echo "<label>UserName: </label>". $username;
        if ($result->num_rows >0){
          while ($row= $result->fetch_assoc()) {
      
      echo "<br>";
      echo "<br>";
       echo "\t<tr><td style='width:290px;height:40px;text-align:center; font-family:Arial;'>".$row['activity']."</td><td style='width:290px;height:40px;text-align:center; font-family:Arial;'>".$row['date_and_time']."";

    }

  }

}

      ?>
    </div></center>
</body>
</html>
<script >
var modal = document.getElementById('java');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>