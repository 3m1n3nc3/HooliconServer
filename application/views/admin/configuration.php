			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line('admin') ?>
									<small><?php echo $this->lang->line('configuration') ?></small>
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

					<p><?php echo $this->session->flashdata('msg') ?></p>
					<?php if ($action == 'configuration'): ?>
						<div class="row">
							<?php if (isset($test_codes)): ?> 
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title"><?php echo $test_codes['message']; ?></h3>
										</div>
										<div class="card-body">
											<?php foreach ($test_codes['response'] as $code): ?>
												<ul class="list-unstyled">
									                <li> 
									                	<a href="" class="btn-link text-secondary">
									                		<i class="fa fa-fw fa-key"></i> <?php echo $code; ?>
									                	</a>
									                </li>
									            </ul>
											<?php endforeach ?>
										</div>
									</div>
								</div>
							<?php endif ?>

							<div class="col-md-8">
								<?php echo form_open_multipart('admin/admin/configuration'); ?>
									<div class="card">
										<div class="card-body">
												
											<div class="row"> 
												<div class="col-md-12 form-group">   
													<label class="custom-file-label" for="site_logo">Choose Site Logo</label>
													<input type="file" name="site_logo" class="custom-file-input" id="site_logo">
													<small class="text-muted">The main logo of this website</small>
													<?php echo form_error('site_logo'); ?>
												</div> 
											</div>
											<hr>
											<div class="row">   

												<div class="col-md-6 form-group">  
													<label for="site_name">Site Name</label>
													<input type="text" name="value[site_name]" value="<?php echo (set_value('value[site_name]') ? set_value('value[site_name]') : $this->my_config->item('site_name')); ?>" class="form-control" >
													<small class="text-muted">The name of this website</small>
													<?php echo form_error('value[site_name]'); ?>
												</div>     

												<div class="col-md-6 form-group">  
													<label for="password">Payment Reference Prefix</label>
													<input type="text" name="value[payment_ref_pref]" value="<?php echo (set_value('value[payment_ref_pref]') ? set_value('value[payment_ref_pref]') : $this->my_config->item('payment_ref_pref')); ?>" class="form-control" >
													<small class="text-muted">The prefix for generated payment reference</small>
													<?php echo form_error('value[payment_ref_pref]'); ?>
												</div> 

												<div class="col-md-6 form-group">  
													<label for="password">Primary Server</label>
													<input type="text" name="value[primary_server]" value="<?php echo (set_value('value[primary_server]') ? set_value('value[primary_server]') : $this->my_config->item('primary_server')); ?>" class="form-control" >
													<small class="text-muted">The server domain from where all products will be hosted</small>
													<?php echo form_error('value[primary_server]'); ?>
												</div>   

												<div class="col-md-6 form-group">  
													<label for="password">Server Directory</label>
													<input type="text" name="value[server_dir]" value="<?php echo (set_value('value[server_dir]') ? set_value('value[server_dir]') : $this->my_config->item('server_dir')); ?>" class="form-control" >
													<small class="text-muted">Directory on the server relative to the root dir</small>
													<?php echo form_error('value[server_dir]'); ?>
												</div>   

												<div class="col-md-6 form-group">  
													<label for="password">Currency Code</label>
													<input type="text" name="value[currency_code]" value="<?php echo (set_value('value[currency_code]') ? set_value('value[currency_code]') : $this->my_config->item('currency_code')); ?>" class="form-control" >
													<small class="text-muted">The base currency for all purchases originating from this site (E.g USD)</small>
													<?php echo form_error('value[currency_code]'); ?>
												</div>  

												<div class="col-md-6 form-group">  
													<label for="password">Currency Symbol</label>
													<input type="text" name="value[currency_symbol]" value="<?php echo (set_value('value[currency_symbol]') ? set_value('value[currency_symbol]') : $this->my_config->item('currency_symbol')); ?>" class="form-control" >
													<small class="text-muted">The symbol for the base currency</small>
													<?php echo form_error('value[currency_symbol]'); ?>
												</div>

												<div class="col-md-6 form-group">  
													<label for="paystack_public">Paystack Public Key</label>
													<input type="text" name="value[paystack_public]" value="<?php echo (set_value('value[paystack_public]') ? set_value('value[paystack_public]') : $this->my_config->item('paystack_public')); ?>" class="form-control" > 
													<?php echo form_error('value[paystack_public]'); ?>
												</div>  

												<div class="col-md-6 form-group">  
													<label for="paystack_secret">Paystack Secret Key</label>
													<input type="text" name="value[paystack_secret]" value="<?php echo (set_value('value[paystack_secret]') ? set_value('value[paystack_secret]') : $this->my_config->item('paystack_secret')); ?>" class="form-control" > 
													<?php echo form_error('value[paystack_secret]'); ?>
												</div>  

												<div class="col-md-6 form-group">  
													<label for="ip_interval">IP Update Interval</label>
													<input type="text" name="value[ip_interval]" value="<?php echo (set_value('value[ip_interval]') ? set_value('value[ip_interval]') : $this->my_config->item('ip_interval')); ?>" class="form-control" >
													<small class="text-muted">The time interval in hours before a user visit can be recorded as unique</small>
													<?php echo form_error('value[ip_interval]'); ?>
												</div>  									

												<div class="col-md-12 form-group">  
													<label for="checkout_info">Checkout Info</label>
													<textarea name="value[checkout_info]" class="form-control" ><?php echo (set_value('value[checkout_info]') ? set_value('value[checkout_info]') : $this->my_config->item('checkout_info')); ?></textarea>
													<small class="text-muted">This is shown on the generated invoice for a user purchase</small>
													<?php echo form_error('value[checkout_info]'); ?>
												</div>  

											</div>  

										</div>
										<!-- /.box-body -->
										<div class="card-footer">  
											<button class="btn btn-flat btn-success" type="submit" name="save">Update</button>
										</div>		 
									</div>
								<?php echo form_close(); ?> 	

							</div>

							<div class="col-md-4">
								<div class="card card-default color-palette-box">
									<div class="card-header"> 
										<h5 class="card-title">
											<i class="fas fa-key"></i>
											Generate Purchase Codes
										</h5>
									</div>
									<div class="card-body">	
										<?php echo form_open('admin/admin/configuration'); ?>
											<div class="input-group input-group mb-3">
												<div class="input-group-prepend"> 
													<select name="purchase_code" class="form-control btn btn-warning">
														<option value="test" <?php echo set_select('purchase_code', 'test', TRUE) ?>>Test</option>
														<option value="save" <?php echo set_select('purchase_code', 'save') ?>>Save</option>
													</select>
												</div>
												<select name="quantity" class="form-control">
													<option value="5" <?php echo set_select('quantity', '5', TRUE) ?>>5</option>
													<option value="10" <?php echo set_select('quantity', '10') ?>>10</option>
													<option value="20" <?php echo set_select('quantity', '20') ?>>20</option>
													<option value="30" <?php echo set_select('quantity', '30') ?>>30</option>
													<option value="40" <?php echo set_select('quantity', '40') ?>>40</option>
													<option value="50" <?php echo set_select('quantity', '50') ?>>50</option>
													<option value="60" <?php echo set_select('quantity', '60') ?>>60</option>
													<option value="70" <?php echo set_select('quantity', '70') ?>>70</option>
													<option value="80" <?php echo set_select('quantity', '80') ?>>80</option>
													<option value="80" <?php echo set_select('quantity', '90') ?>>90</option>
													<option value="100" <?php echo set_select('quantity', '100') ?>>100</option>
												</select> 
											</div>

											<label for="validity">Valid for</label>
											<select name="validity" class="form-control" id="validity">
												<option value="31" <?php echo set_select('validity', '31', TRUE) ?>>1 Month</option>
												<option value="93" <?php echo set_select('validity', '93') ?>>3 Months</option>
												<option value="186" <?php echo set_select('validity', '186') ?>>6 Months</option>
												<option value="372" <?php echo set_select('validity', '372') ?>>1 Year</option> 
												<option value="3720" <?php echo set_select('validity', '3720') ?>>10 Years</option> 
											</select> 
											<div class="icheck-primary">
												<input type="checkbox" id="show" name="show" value="1" <?php echo set_checkbox('show', '1'); ?>>
												<label for="show">
													Show saved codes
												</label>
											</div>
											<button type="submit" class="btn btn-block btn-warning btn-flat">Generate</button>
										<?php echo form_close(); ?> 

										<hr>

										<h5 class="mt-2 text-muted">Purchase Codes Statistics</h5>
										<ul class="list-unstyled">
											<li>
												<a class="btn-link text-secondary"> 
													<i class="fa fa-fw fa-calculator"></i> Total Generated Codes 
												</a> 
												<a class="float-right"><?php echo $keys_counter['total']; ?></a>
											</li> 
											<li>
												<a class="btn-link text-secondary"> 
													<i class="fas fa-fw fa-check-circle"></i> Total Available Codes 
												</a> 
												<a class="float-right"><?php echo $keys_counter['unused']; ?></a>
											</li> 
											<li>
												<a class="btn-link text-secondary"> 
													<i class="far fa-fw fa-credit-card"></i> Total Sold and Used
												</a> 
												<a class="float-right"><?php echo $keys_counter['used']; ?></a>
											</li> 
										</ul> 
									</div> 
								</div>						
							</div>
						</div>

					<?php else: ?>

						<div class="row">
							<div class="col-md-6">
								<div class="card card-default color-palette-box">
									<div class="card-header"> 
										<h5 class="card-title">
											<i class="fas fa-server"></i>
											Create Product
											<?php if ($prid): ?>
												<a href="<?php echo site_url('admin/admin/configuration/products/'.$prid.'/delete') ?>" class="btn btn-danger btn-flat btn-sm">
													<i class="fas fa-trash"></i>
													Delete Product
												</a>
											<?php endif; ?>
										</h5>
									</div>
									<div class="card-body">	
										<?php echo form_open('admin/admin/configuration/products'.($prid ? '/'.$prid : '')); ?>
											<div class="row">
												<div class="col-md-12 form-group"> 
													<label for="product">Title</label>
													<input type="text" name="product" value="<?php echo (set_value('product') || !$prid ? set_value('product') : $product['title']); ?>" class="form-control" id="product" placeholder="Product Manager">
													<?php echo form_error('product'); ?>
												</div>

												<div class="col-md-12 form-group"> 
													<label for="simple">Simple Title</label>
													<input type="text" name="simple" value="<?php echo (set_value('simple') || !$prid ? set_value('simple') : $product['simple_name']); ?>" class="form-control" id="simple" placeholder="Product">
													<?php echo form_error('simple'); ?>
												</div>

												<div class="col-md-12 form-group"> 
													<label for="domain">Product Domain</label>
													<input type="text" name="domain" value="<?php echo (set_value('domain') || !$prid ? set_value('domain') : $product['domain']); ?>" class="form-control" id="domain" placeholder="example.com">
													<?php echo form_error('domain'); ?>
												</div>

												<div class="col-md-12 form-group"> 
													<label for="setup_time">Setup Time</label>
													<select name="setup_time" class="form-control" id="setup_time">
														<option value="24" <?php echo set_select('setup_time', '24', TRUE) ?>>24 Hours</option>
														<option value="48" <?php echo set_select('setup_time', '48') ?>>48 Hours</option> 
														<option value="168" <?php echo set_select('setup_time', '168') ?>>168 Hours</option> 
													</select> 
												</div>

												<div class="col-md-6 form-group"> 
													<label for="tax">Product Tax</label>
													<input type="text" name="tax" value="<?php echo (set_value('tax') || !$prid ? set_value('tax') : $product['tax']); ?>" class="form-control" id="tax" placeholder="10">
													<small class="text-muted">If there is a tax on this product (%)</small>
													<?php echo form_error('tax'); ?>
												</div>

												<div class="col-md-6 form-group"> 
													<label for="shipping">Shipping Fees</label>
													<input type="text" name="shipping" value="<?php echo (set_value('shipping') || !$prid ? set_value('shipping') : $product['shipping']); ?>" class="form-control" id="shipping" placeholder="10">
													<small class="text-muted">If this product requires shipping set the fees</small>
													<?php echo form_error('shipping'); ?>
												</div>

												<div class="col-md-12 form-group"> 
													<label for="description">Product Description</label>
													<textarea type="text" name="description" class="form-control" id="description"><?php echo (set_value('description') || !$prid ? set_value('description') : $product['description']); ?></textarea>
													<?php echo form_error('description'); ?>
												</div>
											</div>
											<div class="btn-group btn-block"> 
												<button type="submit" class="btn btn-warning btn-flat"><?php echo ($prid ? 'Update' : 'Create') ?> Product</button>
												<button type="button" class="btn btn-info btn-flat productPlan_modal" data-modal="products">Manage Products</button>
											</div>
										<?php echo form_close(); ?> 
									</div>
								</div>	
							</div> 
							<div class="col-md-6">
								<div class="card card-default color-palette-box">
									<div class="card-header"> 
										<h5 class="card-title">
											<i class="fas fa-gift"></i>
											Create Plan
											<?php if ($pid): ?>
												<a href="<?php echo site_url('admin/admin/configuration/plans/'.$pid.'/delete') ?>" class="btn btn-danger btn-flat btn-sm">
													<i class="fas fa-trash"></i>
													Delete Plan
												</a>
											<?php endif; ?>
										</h5> 
									</div>
									<div class="card-body">	
										<?php echo form_open('admin/admin/configuration/plans'.($pid ? '/'.$pid : '')); ?>
											<div class="form-group"> 
												<label for="plan">Title</label>
												<input type="text" name="plan" value="<?php echo (set_value('plan') || !$pid ? set_value('plan') : $plan['title']); ?>" class="form-control" id="plan" placeholder="Plan Title">
												<?php echo form_error('plan'); ?>
											</div>

											<div class="form-group"> 
												<label for="price">Price</label>
												<input type="text" name="price" value="<?php echo (set_value('price') || !$pid ? set_value('price') : $plan['price']); ?>" class="form-control" id="price" placeholder="1000">
												<?php echo form_error('price'); ?>
											</div> 

											<div class="form-group">  
												<label for="validity">Valid for</label>
												<select name="validity" class="form-control" id="validity">
													<option value="31" <?php echo set_select('validity', '31', TRUE) ?>>1 Month</option>
													<option value="93" <?php echo set_select('validity', '93') ?>>3 Months</option>
													<option value="186" <?php echo set_select('validity', '186') ?>>6 Months</option>
													<option value="372" <?php echo set_select('validity', '372') ?>>1 Year</option> 
													<option value="3720" <?php echo set_select('validity', '3720') ?>>10 Years</option> 
												</select> 
											</div> 
											<div class="btn-group btn-block"> 
												<button type="submit" class="btn btn-warning btn-flat"><?php echo ($pid ? 'Update' : 'Create') ?> Plan</button>
												<button type="button" class="btn btn-info btn-flat productPlan_modal" data-modal="plans">Manage Plans</button>
											</div>
										<?php echo form_close(); ?> 
									</div>
								</div>	
							</div> 
						</div>	
						
					<?php endif; ?>

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->

			<script type="text/javascript">
			    $(document).on('click', '.productPlan_modal', function () {

			        var endpoint = $(this).data('modal');

			        $('.modal-title').html("");
			        $('.modal-title').html(uc_first(endpoint)+" Manager");

			        $.ajax({
			            type: "post",
			            url: site_url + "admin/product_plan/"+endpoint,
			            data: {'product': 'product'},
			            dataType: "html",
			            success: function (response) {

			                $('.modal-body').html(response);
			                $("#productPlan_modal").modal('show');
			            }
			        });
			    }); 

			    function uc_first(str) {
			        return str.substr(0, 1).toUpperCase() + str.substr(1);
			    }
			</script> 

			<div class="modal fade" id="productPlan_modal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body"> </div> 
					</div> 
				</div> 
			</div> 
