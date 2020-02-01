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
					 
					<?php if ($payments): ?>  
				        <div class="card">
				            <div class="card-header">
				              <h3 class="card-title">Payments Received from users</h3>
				            </div>
							<div class="card-body">
								<table id="products_table" class="table table-bordered table-hover" style="width: 100%;">
	                    			<thead>
	                        			<tr>
											<th>ID</th> 
											<th>Payer Name</th> 
											<th>Amount</th> 
											<th>Reference</th> 
											<th>Details</th>  
											<th>Date</th>   
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>	
						</div>					
					<?php else: ?> 
						
						<h4><?php echo $this->my_config->alert('There are no registered users') ?></h4>  

					<?php endif ?> 					

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
