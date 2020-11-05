<?php
session_start();
require_once("../DataBase.php");

  $tableNum=$_SESSION['tableNo'];
      $parkingNum=$_SESSION['parkingNum'];
      $DB=new DataBase();
      $DB->removeOrderedList($tableNum);
      $DB->clearTable($tableNum);// not working
      $DB->clearParking($tableNum);
      unset($_SESSION['tableNo']);
      unset($_SESSION['parkingNum']);



$MERCHANT_KEY = "Iz9tQSJA";
$SALT = "tVCxvE4ZGT";
$AMOUNT=$_POST['amount'];
// Merchant Key and Salt as provided by Payu.
$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Restaurant Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
  
    <div class="UserForm">
    <form action="<?php echo $action; ?>" method="post" name="payuForm" class="reg-form">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <div class="heading">
				<h3 class="text-center">Required Details</h3>
			</div>
      <div class="form-group">
        <label>Amount: </label>
        <input type="hidden" name="amount" value="<?php echo $AMOUNT; ?>" readonly/>
        <h3><b><?php echo $AMOUNT; ?></b></h3>
			</div>
      <div class="form-group">
        <label>First Name: </label>
        <input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
			</div>
      <div class="form-group">
        <label>Email: </label>
        <input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
			</div>
      <div class="form-group">
        <label>Phone: </label>
        <input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
			</div>
      <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? 'paid for Smart Restaurant.' : $posted['productinfo']; ?>" />
      <input name="surl" type="hidden"value="<?php echo (empty($posted['surl'])) ? 'http://localhost:8080/smartRestaurant/payment/success.php' : $posted['surl'] ?>" size="64" />
      <input name="furl" type="hidden" value="<?php echo (empty($posted['furl'])) ? 'http://localhost:8080/smartRestaurant/payment/failure.php' : $posted['furl'] ?>" size="64" />
       <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
       <div class="form-group">
       <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
			</div>
       <div class="form-group">
       <?php if(!$hash) { ?>
            <input type="submit" value="Submit" />
          <?php } ?>
			</div>
          
        
    </form>
    </div>
    
  </body>
</html>
