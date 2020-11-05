<?php
include "../connection.php";
$from=$_POST['from'];
$to=$_POST['to'];

// $from="2020-10-16";
// $to="2020-10-19";
$sql = "select * FROM transactionDetails WHERE txnDate>=\"$from\" AND txnDate<=\"$to\" ";
$res=mysqli_query($connection, $sql);
$rows = array();
if($res!=null) 
{
    while ($row = mysqli_fetch_array($res)) {
        $rows[] = $row;
    }
}
echo json_encode($rows);
mysqli_close($connection);
?>