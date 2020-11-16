<?php 
session_start();
include "connection.php";
if(isset($_SESSION['logged'])){
    echo "<script>window.location=\"UserDashboard.php\"</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <style>
    body{
    background:url(./images/cheffDashboard.jpg);background-position: inherit;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    }
    </style>
    
</head>
<body>
<div class="header"><h1><center>User Login</center></h1></div>
    <div class="UserForm">
    <form action="?" method="post" class="reg-form">
							<div class="heading">
								<h3 class="text-center">Login to your account</h3>
							</div>
                            <br>
							 <div class="form-group">
						    	<input type="text" class="form-control"  placeholder="number" name="number" required>
							</div>
							<div class="form-group">
						    	<input type="password" class="form-control"  placeholder="Password" name="password" required>
							</div>
							<div class="form-group custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="exampleCheck3">
								<label class="custom-control-label" for="exampleCheck3">Remember me</label>
								<a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
							</div><br>
							<div class="form-group">
                            <button type="submit" class="btn" name="login">Login</button>
                            </div>
		</form>
        <p class="register"><a href="UserRegistration.php" ><b>Not Registered?Click Here!</b></a></p>
    
        <?php
            if(isset($_POST['login']))
            {
                $number=$_POST["number"];
                $password=$_POST["password"];
                $sql = "select password from customerDetails where number={$number}";
                $res=mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($res);
                if($row!=null && $row['password']=== $password){    
                    echo "<script>window.location=\"UserDashboard.php\"</script>";
                    $_SESSION['logged']=1; 
                    die;
                }
                else{
                    echo "<br><br><h3 style=\"color:red;\"><center>Incorrect password or number..</center></h3>";
                }
                mysqli_close($connection);    
            }

        ?>
    </div>
</body>
</html>