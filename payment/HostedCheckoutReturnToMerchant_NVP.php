<?php

/* Main processing page

This is the best NVP example and most useful source code to view if wanting to build an integration. If wanting to utilise REST,
see the Hosted Checkout Return to Merchant REST version.

1. Create one MerchantConfiguration object for each merchant ID.
2. Create one Parser object.
3. Generate a unique Order ID with a method of your choice to use to identify the order. 
4. Set a receipt page to be re-directed to on order completion by using the data-complete tag 
   (alternatively, a function can be specified here).
5. Call Parser object FormRequest method to create a payment page session by making 
   a CREATE_CHECKOUT_SESSION apiOperation request that will be sent to the payment server.
   A successful request will return a session.id and and successIndicator.
6. Store the sussessIndicator and order ID for later use in the receipt page
7. Pass the session.id to the Checkout.configure function which will be called next.
8. When the customer selects the "Payment" button, either call Checkout.showLightbox()
   or  Checkout.showPaymentPage() (note both examples are shown below, but you would only
   use one of these methods).
9. The receipt page compares the sussessIndicator and the resultIndicator to make sure the transaction was successfull, and if
   required, full order details can be retrieved by calling the RETRIEVE_ORDER apiOperation request passing the Order ID. 

*/

session_unset();
session_start();

include "api_lib.php";
include "configuration.php";
include "connection.php"; 
  
  //Ensure this is the first invokation of this page
	if($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		
		if (array_key_exists("submit", $_POST))
	  unset($_POST["submit"]);
		
    $order_amount = $_POST["order_amount"];   
    $order_currency = $_POST["order_currency"];
    $onenet_id = $_POST["onenet_id"];
    $customer_receipt_email = "'" . $_POST["customer_receipt_email"] . "'";
    
    
    //Creates the Merchant Object from config. If you are using multiple merchant ID's, 
		// you can pass in another configArray each time, instead of using the one from configuration.php
    $merchantObj = new Merchant($configArray);

	  // The Parser object is used to process the response from the gateway and handle the connections
	  // and uses connection.php
	  $parserObj = new Parser($merchantObj);

    //The Gateway URL can be set by using the following function, or the 
    //value can be set in configuration.php
    //$merchantObj->SetGatewayUrl("https://secure.uat.tnspayments.com/api/nvp");	
	  $requestUrl = $parserObj->FormRequestUrl($merchantObj);
	
	  //This is a library if useful functions
	  $new_api_lib = new api_lib;

		//Use a method to create a unique Order ID. Store this for later use in the receipt page or receipt function.
    $order_no = $new_api_lib->getRandomString(10);  
    $order_id = $order_no.'-'.$onenet_id; 
   			
   	//Form the array to obtain the checkout session ID.									 
		$request_assoc_array = array("apiOperation"=>"CREATE_CHECKOUT_SESSION",
														 	   "order.id"=>$order_id,
														 	   "order.amount"=>$order_amount,
														     "order.currency"=>$order_currency
														 		);
														 		
		//This builds the request adding in the merchant name, api user and password.											 		
		$request = $parserObj->ParseRequest($merchantObj, $request_assoc_array);
									
		//Submit the transaction request to the payment server
		$response = $parserObj->SendTransaction($merchantObj,$request);
		
		//Parse the response
		$parsed_array = $new_api_lib->parse_from_nvp($response);								 

		//Store the successIndicator for later use in the receipt page or receipt function.
		$successIndicator = $parsed_array['successIndicator'];
 
    //The session ID is passed to the Checkout.configure() function below.
 		$session_id = $parsed_array['session.id'];
 
    //Store the variables in the session, or a database could be used for example
    $_SESSION['successIndicator']= $successIndicator;
    $_SESSION['orderID']= $order_id;
	 
	  $merchantID = "'" . $merchantObj->GetMerchantId() . "'";
  };
  
  ?>
  



    <?php include "header.php"; ?>
    
       <script src="https://easternbank.ap.gateway.mastercard.com/checkout/version/33/checkout.js"
               	 data-error="errorCallback"
               	 data-cancel="http://onesky.com.bd/main/onlinePayment"
                 data-complete="http://onesky.com.bd/payment/Receipt_NVP.php"
                >
       </script>

       <script type="text/javascript">
            function errorCallback(error) {
                alert(JSON.stringify(error));
            }
            
            function completeCallback(resultIndicator, sessionVersion) {
                alert("Result Indicator");
				alert(JSON.stringify(resultIndicator));
                alert("Session Version:");
  				alert(JSON.stringify(sessionVersion));
  				alert("Successful Payment");
            }
           
            function cancelCallback() {
                alert('Payment cancelled');
            }
       
       
			Checkout.configure({
				merchant   : <?php echo $merchantID; ?>,
				order      : {
    				amount     : <?php echo json_encode($order_amount); ?>,
    				currency   : <?php echo json_encode($order_currency); ?>,
    				description: 'Hosted Checkout Test Order - Return to Merchant - PHP/JavaScript/NVP',
    				description: "Onesky Communications Limited Monthly Bill Payment For - <?php echo $onenet_id; ?>",
    				id				 : <?php echo json_encode($order_id); ?>,
    				item			 : {
    					brand: 'Mastercard',
    					description: 'Hosted Checkout Test Item - Return to Merchant - PHP/JavaScript/NVP',
    					name: 'HostedCheckoutItem',
    					quantity: '1',
    					unitPrice: '1.00',
    					unitTaxAmount: '1.00'
    				}
        	   },
				billing    : {
					address  : {
						street: '100 Dilkusha C/A',
						stateProvince: 'Dhaka',
						city: 'Dhaka',
						company: 'Eastern Bank Limited',		
						postcodeZip: '1000',
						country: 'BGD'
					}
				},
				customer :{
					email: <?php echo $customer_receipt_email; ?>
			     },
				interaction: {
    				merchant: {
        		    name: 'PUT YOUR MERCHANT NAME HERE',
        			address: {
        				line1: '100 Dilkusha ',
        				line2: 'Motijheel 1000'
    					},
    					logo:  'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTBLF3ZEk8M5Uh-AU3cxUEyAMScuyuKUF1gJJoN_Zwo4pvXLlpY'
    				}
				},
				session: { 
    			     id: <?php echo json_encode($session_id); ?>
				}
			});
						
        </script>

		<style type="text/css">
			.payment-form{
				width: 60%;
				margin: 0 auto;
				background-color: white;
				-webkit-box-shadow: -5px 1px 29px 0px rgba(224,215,224,1);
				-moz-box-shadow: -5px 1px 29px 0px rgba(224,215,224,1);
				box-shadow: -5px 1px 29px 0px rgba(224,215,224,1);
			}
			.payment-form form{
				padding: 20px;
			}
			.btn{
				border-radius: 0px;
			}
		</style>

			<section class="main-container">
				<div class="container">
					<div class="row">
						<div class="payment-form">

                           <form class="center" action='' method="POST">
                          <fieldset style="margin:0 auto" class="registration-form">
                             <img src="../assets/frontend/images/card.jpg"/>
                               <center><h2>Payment Summary</h2></center><br/>
                                <table class="responstable">
                                  <tr>
                                    <td>Customer id</td>
                                    <td><?php if (isset($onenet_id)) echo $onenet_id ?></td>
                                  </tr>
                                  <tr>
                                    <td>Order Amount</td>
                                    <td>$<?php if (isset($order_amount)) echo $order_amount ?></td>
                                  </tr>
                                  
                                  <tr>
                                    <td>Currency</td>
                                    <td><?php if (isset($order_currency)) echo $order_currency ?></td>
                                  </tr>
                                  
                     
                             </table><br><br>
                             <p style="text-align:center;">
                                  <button type="button" class="btn btn-warning btn-large input-button button_redius" onclick="Checkout.showPaymentPage();">Pay Now</button>
                            </p><br/><br/>
                            <p style="text-align:right;">
                                  <a href="http://onesky.com.bd/main/onlinePayment"><button type="button" class="btn btn-danger input-button" onclick="Checkout.showPaymentPage();">Cancel payment and Return To The Payment Page</button></a>
                            </p>
                          </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </section>


  <?php include "footer.php"; ?>

