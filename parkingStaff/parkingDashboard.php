<?php
    session_start();
    
    require_once("../mainMenuComponent.php");
    require_once("../DataBase.php");
    
    if(!isset($_SESSION['logged'])){
        echo "<script>window.location=\"userLogin.php\"</script>";
    }
    if(isset($_POST['parkingClear']))
    {
        $status=$_POST['status'];
        $parkingNum=$_POST['parkingNum'];
        if($status==="Bill Paid"){
            include "../connection.php";
            $sql="update parkingBooking set `status`=\"available\",`vehicleNum`=\"\",tableNum=0 WHERE parkingNum='$parkingNum'";
            mysqli_query($connection, $sql);
        }
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="../CSS/style.css" rel="stylesheet">
        <link href="../CSS/header-style.css" rel="stylesheet">
        <link href="../CSS/list-style.css" rel="stylesheet">
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
            background-color:white;
            border-radius:10px;
            padding:20px;
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

    
    <div class="d-flex justify-content-end">
    <button type="button" id="refresh-btn" class="btn btn-secondary btn-lg"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;Refresh</button>
    </div>
    <div class="row" id="parkingList">
        <?php 
            $dataBase=new DataBase();
            $comp=new mainMenuComponent();
            
                $tableNum=3;
                $result=$dataBase->getParkingList();
                if($result!=null){
                    while($row=mysqli_fetch_assoc($result)){
                        $comp->parkingSlots($row['parkingNum'],$row['vehicleNum'],$row['status']);
                    }
                     
                }
           
        ?>
    </div>
</div>
<br>
<br>
<script>

  var refresh=document.getElementById("refresh-btn");
  var details=document.getElementById("parkingList");
  refresh.addEventListener("click",function(){
    var httpReq=new XMLHttpRequest();
    httpReq.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("transactions-details").innerHTML = this.responseText;
        // connection failed code here
      }
    };
    httpReq.open('GET','http://localhost:8080/smartRestaurant/parkingStaff/getParkingList.php',true);
    httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpReq.onload=function(){
      var data=JSON.parse(httpReq.responseText);
      renderHTML(data);
    };
    httpReq.send();
  });

  function renderHTML(data){
    var tableRow="";
      for(i=0;i<data.length;i++){
          var red=data[i].status.localeCompare("Reserved");
          var green=data[i].status.localeCompare("Bill Paid");
        color="";
          if(red==0){
            var color="rgba(252,0, 0, 0.5)";
          }
          if(green==0){
            var color="rgba(0,252, 0, 0.5)";
}
      
      tableRow +='<div class="col-md-3 text-center p-5 ">\
          <div class="border rounded-lg">\
          <form method="post" action="">\
              <div class="card" style="height:200px;background-color:'+color+';">\
                  <div class="card-body">\
                      <h5 class="card-title">'+data[i].parkingNum+'</h5>\
                      <h5 class="card-subtitle mb-2 text-muted">'+data[i].vehicleNum+'</h5>\
                      <h5 class="card-subtitle mb-2 text-muted">'+data[i].status+'</h5>\
                      <input type="hidden" name="status" value="'+data[i].status+'">\
                      <input type="hidden" name="parkingNum" value="'+data[i].parkingNum+'">\
                  </div>\
              </div>\
              <button type="submit" value="submit" name="parkingClear" class="btn btn-dark m-3">Clear Parking</button>\
              </form>\
          </div>\
      </div>';
    }
    
    details.innerHTML =tableRow;
  }

</script>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

