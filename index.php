
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
<title>Smart Restaurant</title>
<link rel="stylesheet" href="style.css">
<style>
#pre-loader{
    position:absolute;
    margin:auto;
    display:block;
    z-index:9999;

}


</style>
</head>
<body>
    <div id="pre-loader">
        <img src="./images/loader.gif" id="loader"/>
    </div>
	<div class="header" style="background-color:#343a40!important"><h1><center>GOURMET'S PARADISE</center></h1></div>
    <div class="menu">
	    <ul>
        <li><a href="userLogin.php"><b>USER LOGIN</b></a></li>
        <li>
            <a href="#"><b>STAFF LOGIN</b> &#9662;</a>
            <ul class="dropdown">
                <li><a href="./admin/">ADMIN</a></li>
                <li><a href="./waitigStaff/index.php">WAITER</a></li>
                <li><a href="./cheff/index.php">CHEF</a></li>
                <li><a href="./parkingStaff/index.php">PARKING</a></li>
            </ul>
        </li>
        <li><a href="contact.php"><b>Contact Us</b></a></li>
        </ul>
    </div>
    <div class="register">
	    <p><a href="UserRegistration.php"> <b>NOT REGISTERED?  Register now!</b> </a></p>
   </div>
</body>
</html>