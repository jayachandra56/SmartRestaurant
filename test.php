<?php
    // session_start();
    // include "../connection.php";
    // require_once("../mainMenuComponent.php");
    // require_once("../DataBase.php");
    
    // if(!isset($_SESSION['logged'])){
    //     echo "<script>window.location=\"userLogin.php\"</script>";
    // }
    // if(isset($_POST['start']))
    // {
    //     $ItemId=$_POST['itemID'];
    //     $tableNum=$_POST['tableNum']; 
    //     $sql="update orderList set `STATUS`=\"Started Preparation\" WHERE tabel=$tableNum AND itemID=\"$ItemId\" " ;
    //     $result=mysqli_query($connection, $sql);
    // }
    
    // if(isset($_POST['ready']))
    // {   
    //     $ItemId=$_POST['itemID'];
    //     $tableNum=$_POST['tableNum'];  
    //     $sql="update orderList set `STATUS`=\"Ready\" WHERE tabel=$tableNum AND itemID=\"$ItemId\" " ;
    //     $result=mysqli_query($connection, $sql);
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order</title>
    <!-- bootstrap fro styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
        <link href="header-style.css" rel="stylesheet">
        <link href="list-style.css" rel="stylesheet">
    <style>
    body{
    background:url(../images/cheffDashboard.jpg);
    background-position: inherit;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    }
        .pre-container{
            margin:80px;
        }
        .container{
            z-index:0;
        }
        
        #park, #tab-book{
            color:ghostwhite;
            width:fit-content;
            height:fit-content;
            margin:0px;
        }
        .tabel-btn, .parking-btn{
            width:fit-content;
            margin:0px auto;
            padding:5px 10px;
            background-color:brown;
            border-radius:25px;
            border-style: inset
        }
        .tabelBooking, .parking{
            width:50%;
            float:left;
            padding:10px;
        }
        
        </style>
        
</head>
<body>
<div class="header">
            <div class="title">
                <a href="UserDashboard.php">
                    <h2>
                        GOURMET'S PARADISE
                    </h2>
                </a>
            </div>
            
            <div class="header-menu" style="float:right">
                <div class="dropbtn">
                    <div class="block-one">
                    </div>
                    <div class="block-two">
                    </div>
                    <div class="block-three">
                    </div>
                    <div class="block-four">
                    </div>
                </div>
                <div class="header-menu-content">
                    
                    <a href="../logout.php" id="logout" name="logout"><h4>Logout</h4></a>
                </div>
            </div>
</div><br>
<div class="pre-container">
</div>
<div class="container">
    <div class="row">
      <div class="col-md-3 text-center p-5 ">
          <div class="border rounded-lg">
              <div class="card" style="height:200px;background-color:rgba(252, 0, 0, 0.5);">
                  <div class="card-body">
                      <h5 class="card-title">501</h5>
                      <h5 class="card-subtitle mb-2 text-muted">AP09CK4814</h5>
                      <h5 class="card-subtitle mb-2 text-muted">parked</h5>
                  </div>
              </div>
              <button type="button" class="btn btn-dark m-3">Clear Parking</button>
          </div>
      </div>
      <div class="col-md-3 text-center p-5 ">
          <div class="border rounded-lg">
              <div class="card" style="height:200px;background-color:rgba(0, 252, 0, 0.5);">
                  <div class="card-body">
                      <h5 class="card-title">501</h5>
                      <h5 class="card-subtitle mb-2 text-muted">AP09CK4814</h5>
                      <h5 class="card-subtitle mb-2 text-muted">bill paid</h5>
                  </div>
              </div>
              <button type="button" class="btn btn-dark m-3">Clear Parking</button>
          </div>
      </div>
      <div class="col-md-3 text-center p-5 ">
          <div class="border rounded-lg">
              <div class="card" style="height:200px;">
                  <div class="card-body">
                      <h5 class="card-title">501</h5>
                      <h5 class="card-subtitle mb-2 text-muted"></h5>
                      <h5 class="card-subtitle mb-2 text-muted">Available</h5>
                      
                  </div>
              </div>
              <button type="button" class="btn btn-dark m-3">Clear Parking</button>
          </div>
      </div>
      
      
    </div>
    
    
    
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

