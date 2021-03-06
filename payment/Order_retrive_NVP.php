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

$var1 = $_POST['text1']; 


echo "$var1";


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <link rel="stylesheet" type="text/css" href="assets/paymentstyle.css" />
    <head>
      <title>DirectApi Example</title>
      <meta http-equiv="Content-Type" content="text/html, charset=iso-8859-1">
    </head>
    
    <body>

		<p style="text-align:center;"><a href="../index.html"><img src="https://c.ap1.content.force.com/servlet/servlet.ImageServer?id=01590000008h62j&oid=00D90000000sUDO" alt="Main Order Home Page" /></a></p>
    <center><h1><br/><u>Payment Retrieval Page</u></h1></center>
 
  <br/><br/>
   
   <?php

	 $merchantObj = new Merchant($configArray);

	 $parserObj = new Parser($merchantObj);

	 $requestUrl = $parserObj->FormRequestUrl($merchantObj);
   
	 $request_assoc_array = array("apiOperation"=>"RETRIEVE_ORDER",
														 		"order.id"=>$var1
														 );
	 
	 $request = $parserObj->ParseRequest($merchantObj, $request_assoc_array);
	 $response = $parserObj->SendTransaction($merchantObj, $request);
	 
	 $new_api_lib = new api_lib;
	 $parsed_array = $new_api_lib->parse_from_nvp($response);
	 print_r($parsed_array);
	  
   ?>
   
   <?php

if ($parsed_array['status'] == 'CAPTURED')
	{
?>
		 <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Customer Payment was successful!</h1></center></strong></td>
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
             <td align="right" width="50%"><strong><center><h1>Customer Payment was Unsuccessful!</h1></center></strong></td>
         </tr>
<?php
	}
?>
   
  	
   <table width="60%" align="center" cellpadding="5" border="0">
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
             <td colspan="2" height="25"><center><strong>&nbsp;Order Status: <?php echo $parsed_array['status']; ?> </strong></td>
         </tr>
         </tr>
              <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order Time: <?php echo $parsed_array['creationTime']; ?> </strong></td>
         </tr>
         
           </tr>
              <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Description: <?php echo $parsed_array['description']; ?> </strong></td>
         </tr>
         
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order Curreny: <?php echo $parsed_array['currency']; ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Order ID: <?php  echo $parsed_array['id'] ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Masked Card Number: <?php echo $parsed_array['sourceOfFunds.provided.card.number']; ?> </strong></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Payment Brand: <?php echo $parsed_array['sourceOfFunds.provided.card.brand']; ?> </strong></td>
         </tr>
         
         <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Bank Name: <?php echo $parsed_array['sourceOfFunds.provided.card.issuer']; ?> </strong></td>
         </tr>
         
          <tr>
             <td colspan="2" height="25"><center><strong>&nbsp;Card Holder Name: <?php echo $parsed_array['transaction.acquirer.transactionId']; ?> </strong></td>
         </tr>
   
         
     </table>
         
      
		<h2 align="center"><a href="../index.html">Return to the Main Order Page</a></h2>
   
    
    </body>
<html>