			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
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
					
					<?php if (isset($this->is_admin) && $this->is_admin): ?>

						<div class="text-center m-3">
							<?php echo $installed ? '<a class="btn btn-success disabled">Installed</a>' : '<a class="btn btn-info" href="'.site_url('admin/operation/install/'.$username).'">Install Now</a>' ?>
							<a class="btn btn-warning" href="<?php echo site_url('admin/admin/product/'.$id.'/update') ?>">Update Product</a> 
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
								<?php echo form_open('admin/admin/product/'.$id); ?>
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
														<a class="text-danger ml-3" href="<?php echo site_url('admin/admin/product/'.$id.'/view/'.$err['id'].'/delete') ?>" data-toggle="tooltip" data-placement="left" title="Delete Product">
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
										
					<?php endif ?> 

					<p><?php echo $status ? '<span class="right badge badge-success">Product is Active</span>' : '<span class="right badge badge-danger">Product is Inactive</span>' ?></p>
			    	<div class="row">
			        	<div class="col-md-12">

							<!-- About Me Box -->
							<div class="card card-primary">
								<div class="card-header with-border">
									<h3 class="card-title"><?php echo $site_name ?></h3>
								</div>
								<!-- /.box-header -->
								<div class="card-body">
									<strong><i class="fa fa-user margin-r-5"></i> Owner</strong>
									<p class="text-muted"> <?php echo ucwords($user['name']) ?> </p>
									<hr>
									<strong><i class="fa fa-pencil margin-r-5"></i> Product Name</strong>
									<p class="text-muted"><?php echo ucwords($site_name) ?></p>
									<hr>
									<strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
									<p class="text-muted"><?php echo ucwords($address) ?></p>
									<hr>
									<strong><i class="fa fa-list margin-r-5"></i> Product Type</strong>
									<p> <?php echo $this->product_model->get($product)['title'] ?> </p>
									<hr>
									<strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
									<p class="text-muted"><?php echo $phone ?></p>
									<hr>
									<strong><i class="fa fa-envelope margin-r-5"></i> Assigned Email</strong>
									<p class="text-muted"><?php echo $email ?></p>
									<hr>
									<strong><i class="fa fa-globe margin-r-5"></i> Assigned Url</strong>
									<p class="text-muted"><?php echo $site_url ?></p>
									<hr>
									<strong><i class="fa fa-key margin-r-5"></i> Purchase Code</strong>
									<p class="text-muted"><?php echo $purchase_code ?></p>
									<hr>
									<strong><i class="fa fa-user-secret margin-r-5"></i> Default Password</strong>
									<p class="text-muted"><?php echo $default_password ? $default_password : 'Pending Installation' ?></p>
									<hr>
									<strong><i class="fa fa-info margin-r-5"></i> Running Version</strong>
									<p class="text-muted"><?php echo $app_version ? $app_version : 'Pending' ?></p>
									<hr>
									<strong><i class="fa fa-calendar margin-r-5"></i> Expiry Date</strong>
									<p class="text-muted"><?php echo $expiry ?></p>
									<hr>
									<strong><i class="fa fa-laptop margin-r-5"></i> Last Routine IP</strong>
									<p class="text-muted"><?php echo $ip ? $ip : 'Pending' ?></p>
									<hr>
									<strong><i class="fa fa-file-export margin-r-5"></i> App Date Formate and Time Zone</strong>
									<p class="text-muted"><?php echo ($date_format ? $date_format : 'Pending').' | ' .($timezone ? $timezone : 'Pending') ?></p> 
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
			        	</div>
			        </div>

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->

