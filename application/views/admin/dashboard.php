			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $this->lang->line('admin') ?>
						<small><?php echo $this->lang->line('dashboard') ?></small>
					</h1> 
				</section>
				<!-- Main content -->
				<section class="content"> 
					
					<p><?php echo $this->session->flashdata('msg') ?></p>
					<p>This is your dashboard, where you can track products and activities</p>  
			

					<div class="row">
						<div class="col-lg-3 col-6"> 
							<div class="small-box bg-info">
								<div class="inner">
									<h3><?php echo count($products) ?></h3>
									<p>Active Products</p>
								</div>
								<div class="icon">
									<i class="fas fa-box"></i>
								</div>
								<a href="<?php echo site_url('admin/admin/listproducts') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div> 
						<div class="col-lg-3 col-6"> 
							<div class="small-box bg-success">
								<div class="inner">
									<h3><?php echo count($users) ?></h3>
									<p>Registered Users</p>
								</div>
								<div class="icon">
									<i class="fas fa-user"></i>
								</div>
								<a href="<?php echo site_url('admin/admin/listusers') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div> 
						<div class="col-lg-3 col-6"> 
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?php echo count($payments) ?></h3>
									<p>Payments</p>
								</div>
								<div class="icon">
									<i class="fas fa-credit-card"></i>
								</div>
								<a href="<?php echo site_url('admin/admin/listpayments') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div> 
						<div class="col-lg-3 col-6"> 
							<div class="small-box bg-danger">
								<div class="inner">
									<h3><?php echo count($visitors) ?></h3>
									<p>Unique Visitors</p>
								</div>
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>
								<a href="<?php echo site_url('admin/admin/visitors') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div> 
					</div> 

					<?php if ($errors): ?>
						<!-- Errors -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
								<i class="fas fa-ban mr-1"></i>
								Errors
								</h3>
							</div>
							<!-- /.card-header -->
							<?php echo form_open('admin/admin/dashboard'); ?>
								<div class="card-body">
									<ul class="todo-list" data-widget="todo-list">
										<?php foreach ($errors as $err): ?>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div  class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="<?php echo $err['id'] ?>" name="fix_error[]" id="errorCheck<?php echo $err['id'] ?>">
													<label for="errorCheck<?php echo $err['id'] ?>"></label>
												</div>
												<span class="text text-danger"><?php echo $err['error_text'] ?></span>
												<small class="badge badge-primary"><i class="fa fa-server"></i> <?php echo $err['code'] ?></small><br>

												<?php if ($err['code'] == 'server'): ?>
													<small class="text">You may be offline, connect to the Internet and use the manual propagation form</small> 
												<?php elseif ($err['code'] == 'domain'): ?>
													<small class="text">Change the product username and use the manual propagation form</small> 
												<?php else: ?>
													<small class="text">Change the product email username (the part before the '@') and use the manual propagation form</small> 
												<?php endif ?>

												<div class="tools">
													<a class="text-primary ml-3" href="<?php echo site_url('admin/admin/product/'.$err['product_id'].'/update') ?>" data-toggle="tooltip" data-placement="left" title="Update Product">
														<i class="fas fa-wrench"></i>
													</a>
													<a class="text-warning ml-3" href="<?php echo site_url('admin/operation/manual_propagation/'.$err['product_id']) ?>" data-toggle="tooltip" data-placement="left" title="Manual Propagation">
														<i class="fa fa-server"></i>
													</a> 
													<a class="text-danger ml-3" href="<?php echo site_url('admin/admin/dashboard/'.$err['id'].'/delete') ?>" data-toggle="tooltip" data-placement="left" title="Delete Product">
														<i class="fas fa-trash"></i>
													</a> 
												</div>
											</li> 
										<?php endforeach ?>
									</ul>
								</div>
								<!-- /.card-body -->
								<div class="card-footer clearfix">
									<button type="submit" class="btn btn-danger float-right"><i class="fas fa-check"></i> Fixed</button>
								</div>
							<?php echo form_close(); ?> 
						</div>
						<!-- /Errors -->
					<?php endif ?> 					

					<div class="row">

						<div class="col-md-6">
							
							<div class="card">
								<div class="card-header border-0">
									<h3 class="card-title">Products</h3>
									<div class="card-tools">
										<a href="#" class="btn btn-tool btn-sm">
											<i class="fas fa-download"></i>
										</a>
										<a href="#" class="btn btn-tool btn-sm">
											<i class="fas fa-bars"></i>
										</a>
									</div>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table table-striped table-valign-middle">
										<thead>
											<tr>
												<th>Product</th>
												<th>Prices (<?php echo $this->my_config->item('currency_code') ?>)</th>
												<th>Sales</th>
												<th>Profit</th>
											</tr>
										</thead>
										<tbody>

											<?php if ($get_products): ?>
												<?php foreach ($get_products AS $product): ?>
													<?php $sales = $this->product_model->get_sales($product['id']) ?>
													<tr>
														<td>
															<i class="fas fa-box img-circle img-size-32 mr-2"></i>
															<?php echo $product['title'] ?>
														</td>
														<td><?php echo $get_prices ?></td>
														<td>
															<?php echo $sales['sold'] ?> Sold
														</td>
														<td>
															<small class="text-success mr-1">
																<i class="fas fa-arrow-up"></i>
																<?php echo $this->cr_symbol . number_format($sales['sales']) ?>
															</small>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="4">
														<h4><?php echo $this->my_config->alert('There are no products to show') ?></h4>  
													</td>
												</tr>
											<?php endif; ?>

										</tbody>
									</table>
								</div>
							</div>

						</div>

						<div class="col-lg-6">
							<div class="card">
								<div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Sales</h3>
										<a href="<?php echo site_url('admin/admin/listpayments') ?>">View Report</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg"><?php echo $this->cr_symbol ?> <?php echo number_format($this->product_model->get_sales()['sales']) ?></span>
											<span>Sales Over Time</span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
										<!-- 	<span class="text-success">
												<i class="fas fa-arrow-up"></i> 33.1%
											</span>
											<span class="text-muted">Since last month</span> -->
										</p>
									</div>
									<!-- /.d-flex -->
									<div class="position-relative mb-4">
										<canvas id="sales-chart" height="200"></canvas>
									</div>
									<div class="d-flex flex-row justify-content-end">
										<span class="mr-2">
											<i class="fas fa-square text-primary"></i> This year
										</span>
										<span>
											<i class="fas fa-square text-gray"></i> Last year
										</span>
									</div>
								</div>
							</div>

						</div>
					</div>

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->

			<script type="text/javascript">
				$(function () {
				  'use strict'

				  var ticksStyle = {
				    fontColor: '#495057',
				    fontStyle: 'bold'
				  }

				  var mode      = 'index'
				  var intersect = true

				  var $salesChart = $('#sales-chart')
				  var salesChart  = new Chart($salesChart, {
				    type   : 'bar',
				    <?php echo $sales_stats ?>,
				    options: {
				      maintainAspectRatio: false,
				      tooltips           : {
				        mode     : mode,
				        intersect: intersect
				      },
				      hover              : {
				        mode     : mode,
				        intersect: intersect
				      },
				      legend             : {
				        display: false
				      },
				      scales             : {
				        yAxes: [{
				          // display: false,
				          gridLines: {
				            display      : true,
				            lineWidth    : '4px',
				            color        : 'rgba(0, 0, 0, .2)',
				            zeroLineColor: 'transparent'
				          },
				          ticks    : $.extend({
				            beginAtZero: true,

				            // Include a dollar sign in the ticks
				            callback: function (value, index, values) {
				              if (value >= 1000) {
				                value /= 1000
				                value += 'k'
				              } 
				              return '<?php echo $this->frcr_symbol ?>' + value
				            }
				          }, ticksStyle)
				        }],
				        xAxes: [{
				          display  : true,
				          gridLines: {
				            display: false
				          },
				          ticks    : ticksStyle
				        }]
				      }
				    }
				  })
				});
			</script>
