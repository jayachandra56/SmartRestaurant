<?php
include "../connection.php";

$sql = "select * FROM orderList where STATUS='ordered' ";
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