			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $this->lang->line($page_title) ?>
						<small><?php echo $fullname ?></small>
					</h1> 
				</section>
				<!-- Main content -->
				<section class="content"> 
					
					<p><?php echo $this->session->flashdata('msg') ?></p>
					<p>This is your account, where you can track all your subscriptions and payments</p>
					 
					<?php if ($payments): ?>  
				        <div class="card">
				            <div class="card-header">
				              <h3 class="card-title">Completed Payments</h3>
				            </div>
							<div class="card-body">
								<table id="products_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
	                    			<thead>
	                        			<tr>
											<th>Product Name</th> 
											<th>Plan</th> 
											<th>Reference</th>  
											<th>Amount</th> 
											<th>Description</th>   
											<th>Date</th>   
											<th>Setup</th>   
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>	
						</div>					
					<?php else: ?> 
						
						<h4><?php echo $this->my_config->alert('You have not made any payments') ?></h4> 

					<?php endif ?> 					

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
