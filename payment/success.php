<?php

require_once("../DataBase.php");

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="tVCxvE4ZGT";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
             echo "Invalid Transaction. Please try again";
		   } else {
                  echo "<script>alert(\"Payment Successful. Your Transaction ID is ".$txnid."\")</script>";
                  
                  $DB=new DataBase();
                  $DB->tranxDetails($txnid,$amount,$firstname,$email,$status);
           
                  
                  echo "<script>window.location=\"../UserDashboard.php\"</script>";
                  
		   }
?>	