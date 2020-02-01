						<div class="container-fluid">
							<div class="row">
								<div class="col-12"> 
									<!-- Main content -->
									<div class="invoice p-3 mb-3">
										<!-- title row -->
										<div class="row">
											<div class="col-12">
												<h4>
												<img src="<?php echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>" alt="<?php echo $this->my_config->item('site_name') ?> Logo" class="elevation-3" style="opacity: .8; max-height: 50px;">
					 							<?php echo $this->my_config->item('site_name'); ?>
												<small class="float-right">Date: <?php echo date('Y/m/d', strtotime($invoice['date'])) ?></small>
												</h4>
											</div>
											<!-- /.col -->
										</div>
										<!-- info row -->
										<div class="row invoice-info">
											<div class="col-sm-4 invoice-col">
												From
												<address>
													<strong><?php echo $this->my_config->item('site_name'); ?></strong><br>
													<?php echo $this->my_config->item('contact_address'); ?>
												</address>
											</div>
											<!-- /.col -->
											<div class="col-sm-4 invoice-col">
												To
												<address>
													<strong><?php echo $fullname; ?></strong><br>
													<?php echo $address; ?>
												</address>
											</div>
											<!-- /.col -->
											<div class="col-sm-4 invoice-col">
												<b>Invoice #<?php echo $invoice['id'] ?></b><br>
												<br>
												<b>Order ID:</b> <?php echo $invoice['id'] ?><br>
												<b>Payment <?php echo $invoice['id'] == 'pending' ? 'Due' : 'Date' ?>:</b> <?php echo date('Y/m/d', strtotime($invoice['date'])) ?><br>
												<b>Account ID:</b> <?php echo $id; ?>
											</div>
											<!-- /.col -->
										</div>
										<!-- /.row -->
										<!-- Table row -->
										<div class="row">
											<div class="col-12 table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>Qty</th>
															<th>Product</th>
															<th>Reference #</th>
															<th>Description</th>
															<th>Subtotal</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>1</td>
															<td><?php echo $product['title'] ?></td>
															<td><?php echo $invoice['reference'] ?></td>
															<td><?php echo $invoice['description'] ?></td>
															<td><?php echo $this->cr_symbol.number_format($invoice['amount'], 2) ?></td>
														</tr> 
													</tbody>
												</table>
											</div>
											<!-- /.col -->
										</div>
										<!-- /.row -->
										<div class="row">
											<!-- accepted payments column -->
											<div class="col-6">
												<p class="lead">Payment Methods:</p>
												<img src="<?php echo base_url('backend/images/credit/visa.png') ?>" alt="Visa">
												<img src="<?php echo base_url('backend/images/credit/mastercard.png') ?>" alt="Mastercard">
												<img src="<?php echo base_url('backend/images/credit/paystack.png') ?>" alt="American Express"> 
												<?php if ($this->my_config->item('checkout_info')): ?>
													<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
														<?php echo $this->my_config->item('checkout_info'); ?>
													</p>
												<?php endif; ?> 
											</div>
											<!-- /.col -->
											<div class="col-6">
												<p class="lead">Amount <?php echo $invoice['id'] == 'pending' ? 'Due' : 'Paid' ?> <?php echo date('Y/m/d', strtotime($invoice['date'])) ?></p>
												<div class="table-responsive">
													<table class="table">
														<tr>
															<th style="width:50%">Subtotal:</th>
															<td><?php echo $this->cr_symbol.number_format($invoice['amount'], 2) ?></td>
														</tr>
														<tr>
															<th>Tax (<?php echo $product['tax'] ?>%)</th>
															<td><?php echo $this->cr_symbol.number_format($invoice['amount']*$product['tax']/100, 2) ?></td>
														</tr>
														<tr>
															<th>Shipping:</th>
															<td><?php echo $this->cr_symbol.number_format($product['shipping'], 2) ?></td>
														</tr>
														<tr>
															<th>Total:</th>
															<td><?php echo $this->cr_symbol.(number_format(($invoice['amount']*$product['tax']/100)+$product['shipping']+$invoice['amount'], 2)) ?></td>
														</tr>
													</table>
												</div>
											</div>
											<!-- /.col -->
										</div>
										<!-- /.row -->
										<!-- this row will not appear when printing -->
										<?php if($invoice['id'] == 'pending'): ?>
											<div class="row no-print">

												<div class="col-12"> 
														
													<button type="submit" name="pay" id="paybtn" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment </button>   

													<a href="<?php echo site_url('users/product/invoice/'.$payment_id.'/print') ?>" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

												</div>
											</div>
										<?php endif; ?>
									</div>
									<!-- /.invoice -->
									</div><!-- /.col -->
									</div><!-- /.row -->
								</div>
