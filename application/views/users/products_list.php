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
					 
					<?php if ($products): ?>  
				        <div class="card">
				            <div class="card-header">
				              <h3 class="card-title">Active Products</h3>
				            </div>
							<div class="card-body">
								<table id="products_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
	                    			<thead>
	                        			<tr>
											<th>Product Name</th> 
											<th>Product Type</th> 
											<th>Phone Number</th>  
											<th>Purchase Code</th> 
											<th>Default Password</th>  
											<th>Expiry Date</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>	
						</div>					
					<?php else: ?> 
						 
						<h4><?php echo $this->my_config->alert('You do not have any products at this moment, you can use use the add product menu item to activate one of our products') ?></h4>   
						<hr> 

					<?php endif ?> 					

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
