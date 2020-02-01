			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small><?php echo $plan['title'] ?> <?php echo $product['title'] ?></small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">User Profile</li>
								</ol>
							</div>
						</div>
					</div>
				</section>

				<!-- Main content -->
				<section class="content"> 
					<div class="card">
						<div class="card-body">
							<p><?php echo $this->session->flashdata('msg') ?></p>     

							<h3><?php echo $plan['title'] ?> <?php echo $product['title'] ?></h3> 
							<br> 

							<?php echo form_open('users/product/payment/'.$product['id'].'/'.$plan['id'], array('id' => 'paymentForm')); ?>	
								
								<input type="hidden" name="product" value="<?php echo $product['id'] ?>">
								<input type="hidden" name="plan" value="<?php echo $plan['id'] ?>">
								<input type="hidden" name="amount" value="<?php echo $plan['price'] ?>">
								<input type="hidden" name="total" value="<?php echo (($invoice['amount']*$product['tax']/100)+$product['shipping']+$invoice['amount']) ?>">
								<input type="hidden" name="validity" value="<?php echo $plan['validity'] ?>">  

								<?php echo $load_summary ?> 

							<?php echo form_close() ?>
						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->

			<script src="https://js.paystack.co/v1/inline.js"></script>
			<script type="text/javascript">
			    
			    var $loader = '<div class="loader"><div class="spinner-grow text-warning"></div></div>'; 
			    // var paymentForm = document.getElementById('paymentForm');
			    var paymentBtn = document.getElementById('paybtn');
			    // paymentForm.addEventListener("submit", payWithPaystack, false); 
			    if (paymentBtn) {
			        paymentBtn.addEventListener("click", payWithPaystack);
			    }
 
			    function payWithPaystack() {

			        $('#paybtn').html($loader);
			        $('#paybtn').attr('disabled', 'disabled');

			        var handler = PaystackPop.setup({
			            key: '<?php echo $this->my_config->item('paystack_public') ?>', // Replace with your public key
			            email: '<?php echo $email ?>',
			            currency: '<?php $this->my_config->item('currency_code') ?>',
			            amount: '<?php echo (($invoice['amount']*$product['tax']/100)+$product['shipping']+$invoice['amount'])*100 ?>',
			            firstname: '<?php echo $fname ?>',
			            lastname: '<?php echo $lname ?>',
			            ref: '<?php echo $invoice['reference'] ?>',
			            // label: "Optional string that replaces customer email"
			            onClose: function(){
			                $('.loader').remove();
			                $('#paybtn').removeAttr('disabled');
			                $('#paybtn').html('<i class="far fa-credit-card"></i> Pay Now ');
			                $.ajax({
			                    type: 'POST',
			                    url: '<?php echo site_url('users/product/payment/'.$product['id'].'/'.$plan['id'].'/process') ?>'
			                });
			            },
			            callback: function(response){
			                window.location.href = '<?php echo site_url('users/product/payment_success') ?>?reference=' + response.reference; 
			            }
			        });
			          
			        handler.openIframe();
			    }

			</script>
