
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line('admin') ?>
									<small><?php echo $this->lang->line($page_title) ?></small>
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

					<div class="card card-primary">
						<div class="card-header with-border">
							<h3 class="card-title"><?php echo $site_name ?></h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<?php echo form_open('admin/admin/product/'.$id.'/update'); ?> 
							<div class="card-body">
								<div class="row">
									<div class="col-md-6 form-group">  
										<label for="name"><?php echo $product_settings['simple_name'] ?> Name:</label>
										<input class="form-control" type="text" name="name" value="<?php echo set_value('name') ? set_value('name') : $site_name ?>" id="name">
										<?php echo form_error('name'); ?>
									</div>
									<div class="col-md-6 form-group">
										<label for="email">Email:</label>
										<input class="form-control" type="text" name="email" value="<?php echo set_value('email') ? set_value('email') : $email ?>" id="email">
										<?php echo form_error('email'); ?>
									</div>
									<div class="col-md-6 form-group">
										<label for="username">Username:</label>
										<input class="form-control" type="text" name="username" value="<?php echo set_value('username') ? set_value('username') : $username ?>" id="username">
										<?php echo form_error('username'); ?>
									</div>
									<div class="col-md-6 form-group">
										<label for="phone">Phone:</label>
										<input class="form-control" type="text" name="phone" value="<?php echo set_value('phone') ? set_value('phone') : $phone ?>" id="phone">
										<?php echo form_error('phone'); ?>
									</div>
									<div class="col-md-6 form-group">
										<label for="url">Url:</label>
										<input class="form-control" type="text" name="url" value="<?php echo set_value('url') ? set_value('url') : $site_url ?>" id="url">
										<?php echo form_error('url'); ?>
									</div>
									<div class="col-md-6 form-group">
										<label for="status">Status:</label>
										<select class="form-control" name="status">
											<option value="1" <?php echo  set_select('status', '1'); ?>>Active</option>
											<option value="0" <?php echo  set_select('status', '0'); ?>>Suspend</option>
										</select> 
										<?php echo form_error('url'); ?>
									</div>
									<div class="col-md-12 form-group">
										<label for="address">Address:</label>
										<textarea class="form-control" name="address" id="address"><?php echo set_value('address') ? set_value('address') : $address ?></textarea>  
										<?php echo form_error('address'); ?>
									</div> 
								</div>
		<!-- 						<div class="checkbox">
									<label>
										<input type="checkbox"> Check me out
									</label>
								</div> -->
								<small class="pb-5">
									Please note that, changing certain values on an already activated site might render the site unusable
								</small>  
							</div>
							<!-- /.box-body -->
							<div class="card-footer">  
								<button class="btn btn-success" type="submit" name="save">Update</button>
								<?php echo $installed ? '<a class="btn btn-success disabled mr-1">Installed</a>' : '<a href="'.site_url('admin/operation/install/'.$username).'" class="btn btn-warning mr-1">Install</a>' ?>
								<a class="btn btn-primary mr-1" href="<?php echo site_url('admin/operation/manual_propagation/'.$id) ?>">
									<i class="fa fa-server"></i> Propagate Domain
								</a> 
							</div>
						<?php echo form_close(); ?> 
					</div>
					<!-- /.box -->

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
