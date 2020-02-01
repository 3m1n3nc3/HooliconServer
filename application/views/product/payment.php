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
		  
							<div><?php echo $product['description'] ?></div>
							<hr>

							<h3><?php echo $plan['title'] ?> <?php echo $product['title'] ?></h3> 
							<br> 

							<?php echo form_open('users/product/payment/'.$product['id'].'/'.$plan['id'].'/paystack'); ?>
								
								<input type="hidden" name="product" value="<?php echo $product['id'] ?>">
								<input type="hidden" name="plan" value="<?php echo $plan['id'] ?>">
								<input type="hidden" name="amount" value="<?php echo $plan['price'] ?>">
								<input type="hidden" name="total" value="<?php echo (($invoice['amount']*$product['tax']/100)+$product['shipping']+$invoice['amount']) ?>">
								<input type="hidden" name="validity" value="<?php echo $plan['validity'] ?>">  

								<?php echo $load_invoice ?> 

							<?php echo form_close() ?>
						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper --> 
