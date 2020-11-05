<?php
global $connection;
$host="localhost";
$user="jay";
$pass="12345";
$DB="smartDB";
// $host="fdb28.awardspace.net";
//     $user="3506474_smartdb";
//     $pass="chandra@56";
//     $DB="3506474_smartdb";
$connection = mysqli_connect($host,$user,$pass,$DB) or die("Error " . mysqli_error($connection));
?>