			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small><?php echo $product['title'] ?></small>
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
					<?php echo form_open('users/product/setup/'.$payment_id); ?> 
						<div class="card">
							<div class="card-body">

								<div class="row">
									<div class="col-md-6 form-group">  
										<label for="name"><?php echo $product['simple_name'] ?> Name:</label>
										<input type="text" name="name" value="<?php echo set_value('name') ?>" id="name" class="form-control">
										<?php echo form_error('name'); ?> 
									</div>

									<div class="col-md-6 form-group">  
										<label for="name">Phone Number:</label>
										<input type="text" name="phone" value="<?php echo set_value('phone') ?>" id="phone" class="form-control">
										<?php echo form_error('phone'); ?>
									</div>

									<div class="col-md-12 form-group">  
										<label for="address">Address:</label>
										<textarea name="address" id="address" class="form-control"><?php echo set_value('address') ?></textarea>
										<?php echo form_error('address'); ?>
									</div>
								</div>  

							</div>
							<!-- /.box-body -->
							<div class="card-footer">  
								<button class="btn btn-success" type="submit" name="save">Setup Product</button>
							</div>		 
						</div>
					<?php echo form_close(); ?> 
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
