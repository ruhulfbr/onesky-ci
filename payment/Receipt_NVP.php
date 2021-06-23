<?php
session_start();

include "api_lib.php";
include "configuration.php";
include "connection.php";

error_reporting(E_ALL);

$errorMessage = "";
$errorCode = "";
$gatewayCode = "";
$result = "";

$responseArray = array();

$resultInd =  (isset($_GET["resultIndicator"]))?$_GET["resultIndicator"]:"";
$successInd = $_SESSION['successIndicator']; 

?>
    
<?php include "header.php"; ?>
 
    
<?php

if (strcmp($resultInd, $successInd) == 0)
	{
?>
		 <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Your Payment was successful!</h1></center></strong></td>
         </tr>    
<?php

	}
	else
	{
?>

	<tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Your Payment was Unsuccessful!</h1></center></strong></td>
         </tr>
<?php
	}
?>


  <table width="60%" align="center" cellpadding="5" border="0">

  <?php
    // echo HTML displaying Error headers if error is found
    if ($errorCode != "" || $errorMessage != "") {
  ?>
      <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;Error Response</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><i><?=$errorCode?>: </i></strong></td>
             <td width="50%"><?=$errorMessage?></td>
         </tr>
  <?php
    }
    else {
  ?>
      <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;<?=$gatewayCode?></strong></P></td>
         </tr>
        
  <?php
     }
  ?>
         
  </table>

  <br/><br/>
   
   <?php
   
	$orderID = $_SESSION['orderID'];
	 
	$merchantObj = new Merchant($configArray);

	 $parserObj = new Parser($merchantObj);

	 $requestUrl = $parserObj->FormRequestUrl($merchantObj);

	 $request_assoc_array = array("apiOperation"=>"RETRIEVE_ORDER",
														 		"order.id"=>$orderID
														 );
	 
	 $request = $parserObj->ParseRequest($merchantObj, $request_assoc_array);
	 $response = $parserObj->SendTransaction($merchantObj, $request);
	 
	 $new_api_lib = new api_lib;
	 $parsed_array = $new_api_lib->parse_from_nvp($response);
	// echo '<pre>';
	// print_r($parsed_array);
	// echo '</pre>';
	// 		die(); 
   ?>
   
  	
  <!--  <table width="60%" align="center" cellpadding="5" border="0">
   	<center>
   		
  			 <tr class="title">
             <td colspan="2" height="25"><center><h1><u><strong>&nbsp;Order Details</strong></h1></u></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Merchant: <?php echo $parsed_array['merchant']; ?> </strong></td>
         </tr>
          <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order Amount: <?php echo $parsed_array['amount']; ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order Curreny: <?php echo $parsed_array['currency']; ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order ID: <?php echo $orderID; ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Masked Card Number: <?php echo $parsed_array['sourceOfFunds.provided.card.number']; ?> </strong></td>
         </tr>
         
     </table>
         
      
		<h2 align="center"><a href="../index.html">Return to the Main Order Page</a></h2> -->
   
     <section id="registration-page" class="container padding" style="margin-top: -200px">

       <form class="center" action='' method="POST">
      <fieldset style="width:70%;margin:0 auto" class="registration-form">
         <img src="../assets/frontend/images/card.jpg"/>
           <center><h2>Payment Details</h2></center><br/>
            <table class="responstable">
              <tr>
                <td>Merchant</td>
                <td><?php echo isset($parsed_array['merchant']) ? $parsed_array['merchant'] : ""; ?></td>
              </tr>
              <tr>
                <td>Order Amount</td>
                <td><?php echo isset($parsed_array['amount']) ? $parsed_array['amount'] : ""; ?></td>
              </tr>
              <tr>
                <td>Order Currency</td>
                <td><?php echo isset($parsed_array['currency']) ? $parsed_array['currency'] : ""; ?></td>
              </tr>
              <tr>
                <td>Order ID</td>
                <td><?php echo $orderID ? $orderID : ""; ?></td>
              </tr>
              <tr>
                <td>Payer Name</td>
               <td><?php echo isset($parsed_array['customer.firstName']) ? $parsed_array['customer.firstName'] : ""; ?></td>
              </tr>
              <tr>
              <tr>
                <td>Payer Email</td>
               <td><?php echo isset($parsed_array['customer.email']) ? $parsed_array['customer.email'] : ""; ?></td>
              </tr>

              <tr>
                <td>Masked Card Number</td>
                <td><?php echo isset($parsed_array['sourceOfFunds.provided.card.number']) ? $parsed_array['sourceOfFunds.provided.card.number'] : ""; ?></td>
              </tr>
              
 
         </table><br><br>
         <p style="text-align:center;">
             <a href="http://onesky.com.bd/main/onlinePayment"> <button type="button" class="btn btn-warning input-button button_redius">Return to the Payment Page</button></a>
        </p><br/><br/>

          <div class="why_corporate" style="text-align: left;">
            <li>
              After Payment Collect Your Order Id For Confirmation.
            </li>
            <li>
              After Payment please call to this number (01990 958206) for Your Confirmation.
            </li>
        </div>

      </fieldset>
    </form>
  </section>
<!--       
    <h2 align="center"><a href="../online_payment.php">Return to the Main Order Page</a></h2> -->

  <?php include "footer.php"; ?>
