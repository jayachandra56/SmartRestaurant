<?php 
session_start();
include "../connection.php";
require_once("../mainMenuComponent.php");
require_once("../DataBase.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
  
}
*{
    margin :0px;
    padding :0px;
}
.header{
  width:100%;
  height:100px;
  background-color:#343a40;
  position:fixed;
  z-index:99
}
h1{
  color:#FFF;
  line-height:100px;          
}
.sidebar {
  margin: 0;
  padding: 0;
  width: 15%;
  background-color: #ba9913;
  position: fixed;
  height: 100%;
  overflow: auto;
  margin-top:100px;
}

.sidebar a {
  display: block;
  color: white;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover:not(.active) {
  background-color: white;
  color: #343a40;
}

div.content {
  margin-left: 15%;
  height:100vh;
  width:85%;
  position: absolute;
  margin-top: 100px;
  background-color:#f2f2f2;
  background:url(../images/adminBG.jpg);
  background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
}
#addItem {
  width: 100%;
  padding: 50px 100px;
  text-align: center;
  display:none;
  
}
#addCategory, #viewTransaction {
  width: 100%;
  text-align: center;
  padding:50px 100px;
  display:none;
}
#home {
  width: 100%;
  padding: 10px 40px;
  text-align: center;
}
#home .sales-cards{
  display:flex;
  justify-content:space-around;
}
.card{
  box-shadow: 0px 2px 15px -5px gray;
  border-radius: 10px;
}
/* .card:hover{
  cursor:pointer;
  box-shadow: 0px 5px 15px 0px #888888;

} */
.container{
  margin-top:50px;
  
}
.transcation{
  width: 100%;
background: #fff;
border-radius: 15px;
padding: 10px;
box-shadow: 0px 2px 15px -5px gray;
}


@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
</head>
<body>
<div class="header text-center">
    <h1>
        GOURMET'S PARADISE
    </h1>
</div>

<div class="sidebar">
  <a href="javascript:homeFunction()">Home</a>
  <a href="javascript:categoryFunction()">Add Category</a>
  <a href="javascript:itemFunction()">Add Item</a>
  <a href="javascript:transcFunction()">View Transactions</a>
  <a href="#">Create Employee</a>
  <a href="../logout.php">Logout</a>
</div>

<div class="content">
  <div id="home">
    <!-- <div class="container sales-cards">
      <div class="card">
        <div class="card-body text-center">
          <h4 class="card-title">Last month sale</h4>
          <p class="card-text"><i class="fas fa-rupee-sign pd2"></i>59,643</p>
        </div>
      </div> 
      <div class="card" >
        <div class="card-body text-center">
          <h4 class="card-title">Last week sale</h4>
          <p class="card-text"><i class="fas fa-rupee-sign pd2"></i>59,643</p>
        </div>
      </div> 
      <div class="card">
        <div class="card-body text-center">
          <h4 class="card-title">Yesterday's sale</h4>
          <p class="card-text"><i class="fas fa-rupee-sign pd2"></i>59,643</p>
        </div>
      </div> 
      <div class="card">
        <div class="card-body text-center">
          <h4 class="card-title">Today's sale</h4>
          <p class="card-text"><i class="fas fa-rupee-sign pd2"></i>59,643</p>
        </div>
      </div>
    </div> -->
    <div class="container">
      <div class="container-fluid">
        <h2>Todays Transactions</h2>
      </div>
      <div class="transcation">
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Txn ID</th>
              <th>Txn Date</th>
              <th>Txn Amount</th>
              <th>Txn Status</th>
            </tr>
          </thead>
          <tbody>
            
            <?php 
              $dataBase=new DataBase();
              $comp=new mainMenuComponent();
              $result=$dataBase->todayTranxDetails();
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $comp->todayTransactionList($row['txnID'],$row['txnDate'],$row['amount'],$row['status']);
              } 
              }else{
                echo "<tr>
                <td>---</td>
                <td>---</td>
                <td>---</td>
                <td>---</td>
              </tr>";
              }
              
            ?> 
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="addCategory" >
    <div class="container">
      <div class="sub-header text-center">
        <h2>Add Category</h2>
      </div>
      <br>
      <form action="?" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Category name:</label>
            <input type="text" name="name" class="form-control" placeholder="Category name">
          </div>
          <div class="form-group">
            <label >Upload Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <br>
                <?php
                
                if(isset($_POST['addCategory'])){
                  include "../connection.php";

                  $name = $_POST['name'];
                  $nameDummy=str_replace(' ', '', $name);
                  $itemID=strtolower($nameDummy);
                  $image=$_FILES['fileToUpload']['name'];
                  if($name==="" or $image===""){
                      echo "<script>alert(\"enter valid details!!\")</script>";
                  }
                  else{
                  $target="categoryimages/".basename($_FILES['fileToUpload']['name']);
                  $tmp_name=$_FILES['fileToUpload']['tmp_name'];
                  $qry = "insert INTO mainMenu(itemName,itemID,link, img) VALUES ('$name','$itemID','aaa','$target')";
                  $result = mysqli_query($connection,$qry) or die ('problem in query: ' . mysqli_error($connection));
                  if(move_uploaded_file($tmp_name,$target)){
                      
                      echo "<script>alert(\"Category added successfully!!\")</script>";
                  }
                  else{
                      
                      echo "<script>alert(\"......failed to upload image!!\")</script>";
                  }
                  mysqli_close($connection);
                  }
                }
                ?>
                <br><br>
          <button type="submit" class="btn btn-primary" name="addCategory">Submit</button>
        </form> 
    </div>
  </div>
  <div id="addItem">
    <div class="container">
      <div class="sub-header text-center">
        <h2>Add Item</h2>
      </div>
      <br>
      <form action="?" method="post">
          <div class="form-group">
            <label for="sel1">Select Category:</label>
            <select class="form-control" name="category">
              <?php
                            $qry = "select * FROM mainMenu";
                            
                            $result = mysqli_query($connection,$qry) or die ('problem in query: ' . mysqli_error($conn));
                            if($result>0){
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <option><?php echo $row["itemID"];?></option>
                                    
                                    
                                    <?php
                                    
                                }
                            }
                            
                            ?>
            </select>
          </div> 
          <div class="form-group">
            <label>Item name:</label>
            <input type="text" name="itemName" class="form-control" placeholder="item name">
          </div>
          <div class="form-group">
            <label>Item Price:</label>
            <input type="text" name="itemPrice" class="form-control" placeholder="price">
          </div>
          <br>
                <?php
                
                if(isset($_POST['addItem'])){

                  $category = $_POST['category'];
                  $itemName = $_POST['itemName'];
                  $itemPrice = $_POST['itemPrice'];
                  $itemID=strtoupper($itemName);
                  if($category==="" or $itemName==="" or $itemPrice===""){
                      echo "<script>alert(\"enter valid details!!\")</script>";
                  }
                  else{
                  
                  $qry = "insert INTO itemsList(itemID,name,price,category) VALUES ('$itemID','$itemName','$itemPrice','$category')";
                  $result = mysqli_query($connection,$qry) or die ('problem in query: ' . mysqli_error($connection));
                  if($result){
                      
                      echo "<script>alert(\"Item added successfully!!\")</script>";
                  }
                  mysqli_close($connection);
                  }
                }
                ?>
                <br><br>
          <button type="submit" name="addItem" class="btn btn-primary">Submit</button>
        </form> 
    </div>
  </div>
  <div id="createEmp">
    <div class="container">
      <div class="sub-header text-center">
        <h2>Create Employee</h2>
      </div>
      <br>
      <form action="?" method="post">
          
          <div class="form-group">
            <label>Employee name:</label>
            <input type="text" name="name" class="form-control" placeholder="Employee name">
          </div>
          <div class="form-group">
            <label>Employee Number:</label>
            <input type="text" name="number" class="form-control" placeholder="Employee number">
          </div>
          <div class="form-group">
            <label for="sel1">Select role:</label>
            <select class="form-control" name="category">
              <?php
                            $qry = "select * FROM empRole";
                            
                            $result = mysqli_query($connection,$qry) or die ('problem in query: ' . mysqli_error($conn));
                            if($result>0){
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <option><?php echo $row["role"];?></option>
                                    
                                    
                                    <?php
                                    
                                }
                            }
                            
                            ?>
            </select>
          </div> 
          <div class="form-group">
            <label>Password:</label>
            <input type="text" name="password" class="form-control" placeholder="Employee number">
          </div>
          <div class="form-group">
            <label>Confirm Password:</label>
            <input type="text" name="cpassword" class="form-control" placeholder="Employee number">
          </div>
          <br>
                <?php
                
                if(isset($_POST['create'])){

                  $name = $_POST['name'];
                  $number = $_POST['number'];
                  $password = $_POST['password'];
                  $cpassword = $_POST['cpassword'];
                  $role = $_POST['role'];
                  $itemID=strtoupper($itemName);
                  if($category==="" or $itemName==="" or $itemPrice===""){
                      echo "<script>alert(\"enter valid details!!\")</script>";
                  }
                  else{
                  
                  $qry = "insert INTO empDetails(name,number,role,password) VALUES ('$name','$number','$role','$$password')";
                  $result = mysqli_query($connection,$qry) or die ('problem in query: ' . mysqli_error($connection));
                  if($result){
                      
                      echo "<script>alert(\"Created successfully!!\")</script>";
                  }
                  mysqli_close($connection);
                  }
                }
                ?>
                <br><br>
          <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </form> 
    </div>
  </div>
  <div id="viewTransaction">
    <div class="container">
    
      <div class="col-md-6">
      <div class="sub-header text-center">
        <h2>Select date range</h2>
      </div>
        <label for="email">From Date:</label>
        <input type="date" class="form-control" placeholder="from date" id="from">
        <label for="pwd">To Date:</label>
        <input type="date" class="form-control" placeholder="to date" id="to"><br><br>
        <button type="submit" class="btn btn-primary" id="transactions">Submit</button>
      </div>
    </div><br><br>
    <div class="transcation">
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Txn ID</th>
              <th>Txn Date</th>
              <th>Txn Amount</th>
              <th>Txn Status</th>
            </tr>
          </thead>
          <tbody id="transactions-details">
            <tr>
              <td>---</td>
              <td>---</td>
              <td>---</td>
              <td>---</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
<script>
  function homeFunction() {
    var a = document.getElementById("home");
    var x = document.getElementById("addCategory");
    var y = document.getElementById("addItem");
    var z = document.getElementById("viewTransaction");
    a.style.display = "block";
    x.style.display = "none";
    y.style.display = "none";
    z.style.display = "none";
  }
  function categoryFunction() {
    var a = document.getElementById("home");
    var x = document.getElementById("addCategory");
    var y = document.getElementById("addItem");
    var z = document.getElementById("viewTransaction");
    a.style.display = "none";
      x.style.display = "block";
      y.style.display = "none";
      z.style.display = "none";
  }
  function itemFunction() {
    var a = document.getElementById("home");
    var x = document.getElementById("addCategory");
    var y = document.getElementById("addItem");
    var z = document.getElementById("viewTransaction");
      a.style.display = "none";
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
      
  }
  function transcFunction() {
    var a = document.getElementById("home");
    var x = document.getElementById("addCategory");
    var y = document.getElementById("addItem");
    var z = document.getElementById("viewTransaction");
      a.style.display = "none";
      x.style.display = "none";
      y.style.display = "none";
      z.style.display = "block";
      
  }
  var submit=document.getElementById("transactions");
  var details=document.getElementById("transactions-details");
  submit.addEventListener("click",function(){
    var from=document.getElementById("from").value;
    var to=document.getElementById("to").value;
    var httpReq=new XMLHttpRequest();
    httpReq.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("transactions-details").innerHTML = this.responseText;
        // connection failed code here
      }
    };
    httpReq.open('POST','http://localhost:8080/smartRestaurant/admin/getTransactions.php',true);
    httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpReq.onload=function(){
      var data=JSON.parse(httpReq.responseText);
      console.log(data[0]);
      renderHTML(data);
    };
    httpReq.send("from="+from+"&to="+to);
  });

  function renderHTML(data){
    var tableRow="";
    if(data.length==0){
      tableRow +="<tr><td colspan=\"4\">No data found</td></tr>";
    }
    else{
      for(i=0;i<data.length;i++){
      tableRow +="<tr><td>"+data[i].txnID+"</td><td>"+data[i].txnDate+"</td><td>"+data[i].amount+"</td><td>"+data[i].status+"</td></tr>";
    }
    }
    details.innerHTML =tableRow;
  }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>