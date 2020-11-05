<?php
    session_start();
    require_once("mainMenuComponent.php");
    require_once("DataBase.php");
    if(!isset($_SESSION['logged'])){
        echo "<script>window.location=\"userLogin.php\"</script>";
    }

    if(isset($_SESSION['paymentStatus'])){

        
        }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order</title>
    <!-- bootstrap fro styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script>
$(document).ready(function(){
  $("#logout").click(function(){
    alert("The paragraph was clicked.");
  });
});
</script>
    <style>
         .img-category{
        min-height:260px;
            max-height: 260px;
            min-width: 100%;
            max-width: 100%;
      }
    @media only screen and (max-width: 768px) {
        .img-category{
            min-height:260px;
            max-height: 260px;
            min-width: 100%;
            max-width: 100%;
          }
        .pre-container{
            margin:100px 40px;
        }
        .container{
            z-index:0;
        }
        h4{
            color:#000;
            width:fit-content;
            height:fit-content;
            margin:0px;
            
        }
        #park, #tab-book{
            color:ghostwhite;

        }
        h2{
            color:#FFF;
            margin:0px auto;
            width:fit-content;
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
        
        #table-num{
            clear:both;
        }
     }
     @media only screen and (min-width: 769px) {
     
     .pre-container{
            margin:100px;
        }
        .container{
            z-index:0;
        }
        h4{
            color:#000;
            width:fit-content;
            height:fit-content;
            margin:0px;
            
        }
        #park, #tab-book{
            color:ghostwhite;

        }
        h2{
            color:#FFF;
            margin:0px auto;
            width:fit-content;
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
        
        #table-num{
            clear:both;
        }
     
     }
        </style>

        <link href="style.css" rel="stylesheet">
        <link href="header-style.css" rel="stylesheet">

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
                    <a href="order.php" id="my-order"><h4>My Order</h4></a>
                    <a href="cart.php" id="cart-btn"><h4>Cart</h4>
                    <?php
                        if(isset($_SESSION['cartt'])){
                            $count=count($_SESSION['cartt']);
                            echo "<span id=\"cart-count\" ><h5 style=\"margin:0px auto\">$count</h5></span>   ";
                        }else{
                            echo "<span id=\"cart-count\" ><h5 style=\"margin:0px auto\">0</h5></span>";
                        }
                    ?> 
                    </a>
                    <a href="logout.php" id="logout" name="logout"><h4>Logout</h4></a>
                </div>
            </div>
</div><br>
<div class="pre-container">
    <div class="parking">
        <div class="parking-btn clickable" onclick=window.location.href="parkingBooking.php">
            <h4 id="park">Book Parking</h4>
        </div>
    </div>
    <div class="tabelBooking">
        <div class="tabel-btn clickable" onclick=window.location.href="tableBooking.php">
            <h4 id="tab-book">Book Table</h4>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<?php
    if(isset($_SESSION['tableNo'])){
        $tableno=$_SESSION['tableNo'];
        echo "<h2 id=\"table-num\"><center>Your Table No is : $tableno</center></h2>";
    }
?>
<div class="container">
    <div class="row text-center py-5">
        <?php 
            $dataBase=new DataBase();
            $comp=new mainMenuComponent();
            $result=$dataBase->getMenuitems();
            while($row=mysqli_fetch_assoc($result)){
                $comp->mainMenu($row["itemName"],$row['itemID'],$row['link']);
            } 
        ?>   
    </div>    
</div>
<script>
function getItemList(param){
    // var data=id;
    alert("already added....."+param);
    <?php 

        header("Location:http://localhost:8080/smartRestaurant/itemList.php"); 
        exit; // <- don't forget this!

        ?>

}

</script>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

