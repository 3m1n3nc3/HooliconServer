			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small><?php echo $name ?></small>
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
					<div class="row">
						<div class="col-md-4">
							<?php echo form_open_multipart(isset($upload_action) ? $upload_action : (isset($this->is_admin) ? 'admin/admin/update/upload_photo' : 'users/account/update/upload_photo')); ?>
								<div class="card card-primary card-outline">
									<div class="card-body box-profile">
										<div class="text-center">
											<img class="profile-user-img img-fluid img-circle"
											src="<?php echo $user_photo; ?>"
											alt="User profile picture">
										</div>
										<h3 class="profile-username text-center"><?php echo $name; ?></h3>
										<p class="text-muted text-center"><?php echo ucfirst($role); ?></p>

										<label for="userphoto" class="btn btn-warning btn-block btn-flat" id="upload_label"><b>Choose Image</b></label>
										<button type="submit" class="btn btn-success btn-block btn-flat" id="upload_btn" style="display: none;"><b>Upload Image</b></button>
										<input type="file" name="userphoto" size="20" class="d-none" id="userphoto" /> 
										<?php echo isset($upload_error) ? $upload_error : ''; ?>
									</div>
									<!-- /.card-body -->
								</div>
							<?php echo form_close(); ?> 							
						</div>

						<div class="col-md-8">
							<?php echo form_open(isset($update_action) ? $update_action : (isset($this->is_admin) ? 'admin/admin/update' : 'users/account/update')); ?>
								<div class="card">
									<div class="card-body">

										<div class="row">
											<div class="col-md-6 form-group">  
												<label for="username">Username</label>
												<input type="text" name="username" value="<?php echo $username; ?>" id="username" class="form-control"<?php echo (isset($this->is_admin) ? '' : 'disabled') ?>>
									 			<?php echo form_error('username'); ?>
											</div>

											<div class="col-md-6 form-group">  
												<label for="password">Password</label>
												<input type="password" name="password" value="<?php echo set_value('password'); ?>" id="password" class="form-control" >
												<?php echo form_error('password'); ?>
											</div>

											<div class="col-md-6 form-group">  
												<label for="email">Email</label>
												<input type="text" name="email" value="<?php echo set_value('email') ? set_value('email') : $email; ?>" id="email" class="form-control">
												<?php echo form_error('email'); ?>
											</div>
											
											<div class="col-md-6 form-group">  
												<label for="phone">Phone</label>
												<input type="text" name="phone" value="<?php echo set_value('phone') ? set_value('phone') : $phone; ?>" id="phone" class="form-control">
												<?php echo form_error('phone'); ?>
											</div>
											
											<div class="col-md-6 form-group">  
												<label for="fname">First Name</label>
												<input type="text" name="fname" value="<?php echo set_value('fname') ? set_value('fname') : $fname; ?>" id="fname" class="form-control"> 
												<?php echo form_error('fname'); ?>
											</div>
											
											<div class="col-md-6 form-group">  
												<label for="lname">Last Name</label>
												<input type="text" name="lname" value="<?php echo set_value('lname') ? set_value('lname') : $lname; ?>" id="lname" class="form-control"> 
												<?php echo form_error('lname'); ?>
											</div> 
										
											<div class="col-md-12 form-group">  
												<label for="type">Address</label>
												<textarea name="address" class="form-control" ><?php echo set_value('address') ? set_value('address') : $address; ?></textarea> 
												<?php echo form_error('address'); ?>
											</div>  
										</div>  

									</div>
									<!-- /.box-body -->
									<div class="card-footer">  
										<button class="btn btn-success" type="submit" name="save">Update</button>
									</div>		 
								</div>
							<?php echo form_close(); ?> 
						</div>

					</div>

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
			
			<script type="text/javascript">
				$(document).on('change', '#userphoto', function () {
					$('#upload_btn').show();
					$('#upload_label').hide();
				});
			</script>
