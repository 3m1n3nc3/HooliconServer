			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $this->lang->line('admin') ?>
						<small><?php echo $this->lang->line($page_title) ?></small>
					</h1> 
				</section>
				<!-- Main content -->
				<section class="content"> 
					
					<p><?php echo $this->session->flashdata('msg') ?></p> 
					 
					<?php if ($products): ?>  
				        <div class="card">
				            <div class="card-header">
				              <h3 class="card-title">List of currently active products</h3>
				            </div>
							<div class="card-body">
								<table id="products_table" class="table table-bordered table-hover" style="width: 100%;">
	                    			<thead>
	                        			<tr>
											<th>Product Name</th> 
											<th>Product Type</th> 
											<th>Phone Number</th>  
											<th>Purchase Code</th> 
											<th>Default Password</th>  
											<th>Expiry Date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>	
						</div>					
					<?php else: ?> 
						
						<h4><?php echo $this->my_config->alert('You do not have any products') ?></h4>  

					<?php endif ?> 					

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
