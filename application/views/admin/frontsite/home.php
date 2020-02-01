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
					
					<a href="<?php echo site_url('admin/frontsite/add_content') ?>" class="btn btn-primary btn-lg my-2">Create Content</a>
					<hr>
					<div class="row">						

						<div class="col-md-12">
							<?php echo form_open('admin/frontsite/add_content/set/section'); ?>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Content Sections</h3>
									</div>
									<div class="card-body">

										<div class="form-group">  
											<label for="type">Type</label>
											<select name="section" class="form-control"> 
												<option value="services"<?php echo set_select('section', 'services'); ?>>Our Services</option>
												<option value="products"<?php echo set_select('section', 'products'); ?>>Products</option> 
												<option value="team"<?php echo set_select('section', 'team'); ?>>Team</option>
												<option value="contact"<?php echo set_select('section', 'contact'); ?>>Contact</option>
											</select> 
											<button class="btn btn-flat btn-success mt-1" type="submit" name="up_section">Update Section</button>
											<?php echo form_error('value[type]'); ?>
										</div>  

									</div> 
								</div>
							<?php echo form_close(); ?> 
						</div>

						<?php if ($content): ?>  
							<div class="col-md-12">
						        <div class="card">
						            <div class="card-header">
						              <h3 class="card-title">List of available content</h3>
						            </div>
									<div class="card-body">
										<table id="products_table" class="table table-bordered table-hover" style="width: 100%;">
			                    			<thead>
			                        			<tr>
													<th>Title</th> 
													<th>Type</th>   
													<th>Image</th> 
													<th>Content</th>   
													<th>Actions</th>   
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>	
								</div>	
							</div>				
						<?php else: ?> 
							
							<h4><?php echo $this->my_config->alert('You have not created any content') ?></h4>  

						<?php endif ?> 					

					</div>

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
