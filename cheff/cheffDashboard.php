<?php
    session_start();
    include "../connection.php";
    require_once("../mainMenuComponent.php");
    require_once("../DataBase.php");
    
    if(!isset($_SESSION['logged'])){
        echo "<script>window.location=\"userLogin.php\"</script>";
    }
    if(isset($_POST['start']))
    {
        $ItemId=$_POST['itemID'];
        $tableNum=$_POST['tableNum']; 
        $sql="update orderList set `STATUS`=\"Started Preparation\" WHERE tabel=$tableNum AND itemID=\"$ItemId\" " ;
        $result=mysqli_query($connection, $sql);
    }
    
    if(isset($_POST['ready']))
    {   
        $ItemId=$_POST['itemID'];
        $tableNum=$_POST['tableNum'];  
        $sql="update orderList set `STATUS`=\"Ready\" WHERE tabel=$tableNum AND itemID=\"$ItemId\" " ;
        $result=mysqli_query($connection, $sql);
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
    <link href="../style.css" rel="stylesheet">
        <link href="../header-style.css" rel="stylesheet">
        <link href="../list-style.css" rel="stylesheet">
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
    <div class="d-flex justify-content-end">
        <button type="button" id="refresh-btn1" class="btn btn-primary btn-lg"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;Refresh</button>
    </div>

    <div class="list-group" id="items-list">
        <div class="list-group-item" style="background-color:#ce1e1e;">
            <h4 id="heading-name">Item Name</h4>
            <h4 id="heading-qty">Quantity</h4>
            <h4 id="heading-status">Table No</h4>
        
        </div>
        <?php 
            $dataBase=new DataBase();
            $comp=new mainMenuComponent();
            
                $tableNum=3;
                $result=$dataBase->getCheffOrderedList();
                if($result!=null){
                    while($row=mysqli_fetch_assoc($result)){
                        $comp->cheffOrdersItemComponent($row["itemName"],$row["itemID"],$row["quantity"],$row["tabel"]);
                    }
                     
                }else{
                echo "<h1><center>No Items Ordered</center></h1>";
                }
           
        ?>
    </div>
</div>

<script>

  var refresh=document.getElementById("refresh-btn1");
  var details=document.getElementById("items-list");
  refresh.addEventListener("click",function(){
      
    var httpReq=new XMLHttpRequest();
    httpReq.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("transactions-details").innerHTML = this.responseText;
        // connection failed code here
        
      }
    };
    httpReq.open('GET','http://localhost:8080/smartRestaurant/cheff/getOrderedItems.php',true);
    httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpReq.onload=function(){
      var data=JSON.parse(httpReq.responseText);
      console.log(data);
      renderHTML(data);
    };
    httpReq.send();
  });
  function renderHTML(data){
    var tableRow='<div class="list-group-item" style="background-color:#ce1e1e;">\
            <h4 id="heading-name">Item Name</h4>\
            <h4 id="heading-qty">Quantity</h4>\
            <h4 id="heading-status">Table No</h4>\
        </div>';
        if(data.length>0){
            for(i=0;i<data.length;i++){
                tableRow +='<form method="POST" action=""><div class="list-group-item"><h4 id="item-name">'+data[i].itemName+'</h4><h4 id="item-qty">'+data[i].quantity+'</h4><h4 id="item-tableNum">'+data[i].tabel+'</h4><button id=\"btn-addCart\" name=\"start\" value=\"\">Start Preparing</button><button id=\"btn-addCart\" name=\"ready\" value=\"\">Ready to serve</button><div style="clear:both"></div><input type="hidden" name="itemID" value="'+data[i].itemID+'"><input type="hidden" name="tableNum" value="'+data[i].tabel+'"></div></form>';
                    
            }
       }else{
           tableRow+='<h1><center>No Items Ordereddd'+(data.length>=1)+'</center></h1>';
       }
        
      
    
    details.innerHTML =tableRow;
  }
 

</script>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

