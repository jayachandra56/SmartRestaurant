<?php
session_start();
include "connection.php";
require_once("DataBase.php");
if(!isset($_SESSION['logged'])){
    echo "<script>window.location=\"userLogin.php\"</script>";
}
if(isset($_SESSION['tableNo'])){
    echo "<script>alert(\"Table Already Booked\")</script>";
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
<div class="header"><h1><center>Table Booking</center></h1></div>
    <div class="UserForm">
        <form action="" method="post" class="reg-form">
            <br><input type="text" name="noOfSeats" placeholder="Enter no of seats required" required><br><br>
            <button type="submit" name="submit-btn" ><b>Submit<b></button>
        </form>
    
        <?php
            if(isset($_POST['submit-btn']))
            {
                
                $number=$_POST["noOfSeats"];
                if($number<=8 && $number>0)
                {
                $res="";

                $sql = "select * FROM tableBooking where (noOfSeats >=\"$number\" AND status=\"available\")";
                $resul=mysqli_query($connection, $sql);
                while($row=mysqli_fetch_assoc($resul)){
                    // $comp->listItemComponent($row["name"],$row["price"],$row["itemID"]);
                    $res=$row['tableNo'];
                    $_SESSION['tableNo']=$row['tableNo'];
                break;
                } 
                $sql="update tableBooking set `status`=\"reserved\" WHERE tableNo=$res";
                mysqli_query($connection, $sql);
                
                echo "<script>alert(\"Table $res Booked Successfully.\")</script>";
                echo "<script>window.location=\"UserDashboard.php\"</script>";
                
                mysqli_close($connection);
                }else{
                      $string = 'Required seats are higher please contact us to book your table.\n                                          Thank You';
                       echo "<script>alert(\"$string\")</script>";
                       echo "<script>window.location=\"UserDashboard.php\"</script>";
                }
                
            }

        ?>
    </div>
</body>
</html>