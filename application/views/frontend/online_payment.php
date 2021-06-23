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
				<br>
				<center><img src="<?php echo base_url('assets/frontend/'); ?>images/card.jpg"/></center><br>
				<center><h3 class="title">Payment Details</h3></center>
				<form action='<?php echo base_url(); ?>payment/HostedCheckoutReturnToMerchant_NVP.php' method="POST">
				  <div class="form-group">
				    <input type="email" name="customer_receipt_email" placeholder="Enter your email" class="form-control" required>
				  </div>
				  <div class="form-group">
				    <input type="text" name="onenet_id" placeholder="Enter your OneSky ID" class="form-control" required>
				  </div>
				  <div class="form-group">
				    <input type="text" name="order_currency" value="BDT" class="form-control" required >
				  </div>
				  <div class="form-group">
				    <input type="number" name="order_amount" placeholder="Enter Amount" class="form-control" required>
				  </div>
				  <button type="submit" class="btn btn-success">Submit Payment</button>
				</form>
			</div>
		</div>
	</div>
</section>

