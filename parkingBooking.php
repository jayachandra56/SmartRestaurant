<?php
session_start();
include "connection.php";
if(isset($_SESSION['parkingNum'])){
        echo "<script>alert(\"Parking Booked Already..\")</script>";
        echo "<script>window.location=\"UserDashboard.php\"</script>";
    }
if(!isset($_SESSION['logged'])){
    echo "<script>window.location=\"userLogin.php\"</script>";
}
if(!isset($_SESSION['tableNo'])){
    echo "<script>alert(\"Please book your table first..\")</script>";
    echo "<script>window.location=\"UserDashboard.php\"</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Restaurant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header"><h1><center>Parking Booking</center></h1></div>
    <div class="UserForm">
        <form action="" method="post" class="reg-form">
            <br><input type="text" name="vehNum" placeholder="Enter vehicle number" required><br><br>
            <button type="submit" name="submit-btn" ><b>Submit<b></button>
        </form>
    
        <?php
            if(isset($_POST['submit-btn']))
            {
                
                $vehNumber=$_POST["vehNum"];
                $tableNum=$_SESSION['tableNo'];
                $res="";

                $sql = "select * FROM parkingBooking where status=\"available\"";
                $resul=mysqli_query($connection,$sql);
                while($row=mysqli_fetch_assoc($resul)){
                    // $comp->listItemComponent($row["name"],$row["price"],$row["itemID"]);
                    $res=$row['parkingNum'];
                    $_SESSION['parkingNum']=$row['parkingNum'];
                break;
                } 
                $sql="update parkingBooking set `status`=\"Reserved\",`tableNum`=\"$tableNum\",`vehicleNum`=\"$vehNumber\" WHERE parkingNum=$res";
                mysqli_query($connection, $sql);
                
                echo "<script>alert(\"Parking $res Booked Successfully.\")</script>";
                echo "<script>window.location=\"UserDashboard.php\"</script>";
                
                mysqli_close($connection);
                
            }

        ?>
    </div>
</body>
</html>