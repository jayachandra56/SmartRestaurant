<?php
    session_start();
    require_once("mainMenuComponent.php");
    require_once("DataBase.php");
    
    if(!isset($_SESSION['logged'])){
        echo "<script>window.location=\"userLogin.php\"</script>";
    }
    if(isset($_POST['btn-palaceOrder'])){
        $DB=new DataBase();
        $product_id=array_column($_SESSION['cartt'],'itemID');
        $product_QTY=array_column($_SESSION['quantity'],'quantity');
        $product_name=array_column($_SESSION['itemName'],'itemName');
        $tableNum=$_SESSION['tableNo'];
        $position=0;
        foreach($product_QTY as $id){
            $DB->placeOrder($product_name[$position],$product_id[$position],$product_QTY[$position],$tableNum);
            $position=$position+1;
        }

        echo "<script>alert(\"Order Placed Successfully!!\")</script>";
        echo "<script>window.location=\"UserDashboard.php\"</script>";
        
        
        // clearing all session variables..
        unset($_SESSION['cartt']);
        unset($_SESSION['quantity']);
        unset($_SESSION['itemNum']);
        unset($_SESSION['itemName']);
    }
    if(isset($_POST['remove']))
    {
        $product_id=array_column($_SESSION['cartt'],'itemID');
        $removeItemId=$_POST['itemID'];
        $removeItemNum=$_POST['itemNum'];
        foreach($product_id as $products){
            if($products===$removeItemId){

                // removing item using index number from session variables..
                unset($_SESSION['cartt'][$removeItemNum]);
                unset($_SESSION['quantity'][$removeItemNum]);
                unset($_SESSION['itemName'][$removeItemNum]);
                unset($_SESSION['itemNum'][$removeItemNum]); 
            }
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
    <!-- font awesome for icons -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
       
        .container{
            margin-top:20px;
        }     
        h2{
            color:#FFF;
            width:fit-content;
            margin:0px auto;
        }  

        h4{
            color:#000;
            width:fit-content;
            height:fit-content;
            margin:0px;
            
        }
        
    </style>

    <link href="./CSS/style.css" rel="stylesheet">
    <link href="./CSS/list-style.css" rel="stylesheet">
    <link href="./CSS/header-style.css" rel="stylesheet">


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
                    <a href="index.php" id="logout"><h4>Logout</h4></a>
                </div>
            </div>
</div><br>
<div style="margin-top:100px ">
<form method="post" action="UserDashboard.php">
    <center><button name="btn-mainmenu" style="background-color: #ce1e1e;padding:10px;border-radius:15px;border-color: bisque;color: #FFF;"><h4 style="color:#fff">Main Menu</h4></button></center>
</form>
</div>
<div class="container">
    <div class="list-group" >
        <div class="list-group-item" style="background-color:#ce1e1e;">
            <h4 id="heading-name">Item Name</h4>
            <h4 id="heading-price">Price</h4>
            <h4 id="heading-qty">Qty</h4>
            
        </div>
        <?php
        if(isset($_SESSION['cartt'])){
            $DB=new DataBase();
            $comp=new mainMenuComponent();
            $product_id=array_column($_SESSION['cartt'],'itemID');
            $product_QTY=array_column($_SESSION['quantity'],'quantity');
            $itemNum=array_column($_SESSION['itemNum'],'itemNum');
            $result=$DB->getitemsList();
            
            while($row=mysqli_fetch_assoc($result)){
                $position=0;
                foreach($product_id as $id){
                
                    if($row['itemID']==$id){
                        $comp->cartItemComponent($row["name"],$row["price"],$row["itemID"],$product_QTY[$position],$itemNum[$position]);
                        
                    }
                    $position=$position+1;
                }
            }

        }else{
            echo "<h2>Cart is Empty</h2>";
        }
        ?>
        
    </div>
</div>
<?php
$element="
<hr>
<form method=\"post\">
<center><button name=\"btn-palaceOrder\" style=\"background-color: #ce1e1e;padding:10px;border-radius:15px;border-color: bisque;color: #FFF;\"><h5 style=\"color:#FFF\">Place Order</h5></button></center>  <hr> 
<br><br><br>
</form>";
if(isset($_SESSION['cartt'])){
    echo $element;
}
?>
<br><br>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>