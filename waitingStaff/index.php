<?php 
session_start();
include "../connection.php";
if(isset($_SESSION['logged'])){
    echo "<script>window.location=\"waiterDashboard.php\"</script>";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body style="background:url(../images/cheffBG.jpg);background-position: inherit;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;">
<div class="header text-center"><h1>Waiter Login</h1></div>
    <div class="UserForm">
        <form action="?" method="post" class="reg-form">
							<div class="heading">
								<h3 class="text-center">Login to your account</h3>
							</div>
							 <div class="form-group">
						    	<input type="text" class="form-control" id="exampleInputEmail3" placeholder="user id" name="userid" required>
							</div>
							<div class="form-group">
						    	<input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password" required>
							</div>
							<div class="form-group custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="exampleCheck3">
								<label class="custom-control-label" for="exampleCheck3">Remember me</label>
								<a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
							</div>
                            <br>
							<button type="submit" class="btn btn-log btn-block btn-thm2" name="login">Login</button>
		</form>
    
        <?php
            if(isset($_POST['login']))
            {
                $number=$_POST["userid"];
                $password=$_POST["password"];
                
                $sql = "select password from customerDetails where number={$number}";
                $res=mysqli_query($connection, $sql);
                $row="";
                if($res>0){
                    $row = mysqli_fetch_array($res);
                }
                if($row!=null && $row['password']=== $password){
                    
                    header( "Location: http://localhost:8080/smartRestaurant/waitingStaff/waiterDashboard.php" );
                    $_SESSION['logged']=1; 
                    die;
                }
                else{
                    echo "<br><br><h3 style=\"color:#1a9e1e;\"><center>Incorrect password or number..</center></h3>";
                }
                mysqli_close($connection);
                
            }

        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>