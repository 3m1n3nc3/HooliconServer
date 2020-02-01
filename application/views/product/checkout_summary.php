						
							<div class="container-fluid text-center m-3">
								<img src="<?php echo base_url('backend/images/credit/paystack_secured.png') ?>" alt="Paystack Secured" style="max-width: 400px;">
							</div><div class="container-fluid">

							<div class="row">
								<div class="col-12"> 
									<!-- Main content -->
									<div class="invoice p-3 mb-3">   
										<div class="row">
											<!-- accepted payments column -->
											<div class="col-6"> 
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
												<p class="lead">Summary</p>
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
														
													<button type="submit" name="pay" id="paybtn" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Pay Now </button>    

												</div>
											</div>
										<?php endif; ?>
									</div>
									<!-- /.invoice -->
									</div><!-- /.col -->
									</div><!-- /.row -->
								</div>
