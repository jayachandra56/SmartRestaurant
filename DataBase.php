
<?php

class DataBase{
    
    function getMenuitems(){
        include "connection.php";
        $sql="select * from mainMenu";
        $result=mysqli_query($connection, $sql);
        if(mysqli_num_rows($result)>0){
            return $result;
        }
        mysqli_close($connection);
    
    }

    function getitemsCustomList($category){
        include "connection.php";
        $sql="select * from itemsList where category=\"$category\"";
        $result=mysqli_query($connection, $sql);
            if(mysqli_num_rows($result)>0){
                return $result;
            }
            mysqli_close($connection);
    
    }

    function getitemsList(){
        include "connection.php";
                    $sql="select * from itemsList";
    
                    $result=mysqli_query($connection, $sql);
    
                    if(mysqli_num_rows($result)>0){
                        return $result;
                    }
                    mysqli_close($connection);
    
    }

    function placeOrder($itemName,$itemID,$qty,$tabel){
        include "connection.php";
        $price_qry="select price from itemsList where itemID=\"$itemID\"";
        $res=mysqli_query($connection, $price_qry);
        while($row=mysqli_fetch_assoc($res)){
            $price=$row['price'];
        }
        $sql="INSERT INTO orderList(itemName, itemID, quantity, price, tabel,STATUS) VALUES (\"$itemName\",\"$itemID\",\"$qty\",$price,\"$tabel\",\"Ordered\")";
    
        $result=mysqli_query($connection, $sql);
    
        
            return $result;
        
        mysqli_close($connection);


    }

    function getOrderedList($tableNum){
        include "connection.php";
                    $sql="select * from orderList where tabel=\"$tableNum\"";
    
                    $result=mysqli_query($connection, $sql);
    
                    if(mysqli_num_rows($result)>0){
                        return $result;
                    }
                    mysqli_close($connection);
    
    }
    function removeOrderedList($tableNum){
        include "connection.php";
                    $sql="delete from orderList where tabel=\"$tableNum\"";
    
                    $result=mysqli_query($connection, $sql);
                    mysqli_close($connection);
    }

    function clearTable($tableNum){
        include "connection.php";
                    $sql="update tableBooking set `status`=\"available\" WHERE tableNo=$tableNum";
    
                    $result=mysqli_query($connection, $sql);
                    mysqli_close($connection);
    }

    function clearParking($tableNum){
        include "connection.php";
                    $sql="update parkingBooking set `status`=\"Bill Paid\" WHERE tableNum=$tableNum";
    
                    $result=mysqli_query($connection, $sql);
                    mysqli_close($connection);
    }


    function getCheffOrderedList(){
        include "connection.php";
                    $sql="select * from orderList where `STATUS`!=\"Ready\"";
    
                    $result=mysqli_query($connection, $sql);
    
                    if(mysqli_num_rows($result)>0){
                        return $result;
                    }
                    mysqli_close($connection);
    
    }
    
    
    function getWaiterOrderedList(){
        include "connection.php";
                    $sql="select * from orderList where `STATUS`=\"Ready\"";
    
                    $result=mysqli_query($connection, $sql);
    
                    if(mysqli_num_rows($result)>0){
                        return $result;
                    }
                    mysqli_close($connection);
    
    }

    function tranxDetails($txnid,$amount,$firstname,$email,$status){
        include "connection.php";
        $date=date("Y-m-d");
        $time=date("h:i:sa");
        // $date="";
        // $time="";
        $sql="insert INTO transactionDetails(`txnID`,`amount`,`txnDate`,`txnTime`,`status`) VALUES (\"$txnid\",\"$amount\",\"$date\",\"$time\",\"$status\")";
        // $sql="select * from transactionDetails";
        $result=mysqli_query($connection, $sql);
        
            return $result;
        
        mysqli_close($connection);
    
    }

    function getParkingList(){
        include "connection.php";
                    $sql="select * from parkingBooking ";
    
                    $result=mysqli_query($connection, $sql);
    
                    if(mysqli_num_rows($result)>0){
                        return $result;
                    }
                    mysqli_close($connection);
    
    }


    function todayTranxDetails(){
        include "connection.php";
        $date=date("Y-m-d");
        $sql="select * FROM `transactionDetails` WHERE txnDate=\"$date\"";
        // $sql="select * from transactionDetails";
        $result=mysqli_query($connection, $sql);
        
            return $result;
        
        mysqli_close($connection);
    
    }

    
}

?>

