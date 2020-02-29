<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo site_url('') ?>"><img src="<?php echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>"/><?php //echo $this->my_config->item('site_name') ?></a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign up to products</p>
			<p><?php echo $this->session->flashdata('msg') ?></p> 
			<?php echo form_open('access/signup'); ?>

				<?php echo form_error('username'); ?>
				<div class="input-group mb-3">  
					<input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" id="username" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>

				<?php echo form_error('email'); ?>
				<div class="input-group mb-3">
					<input class="form-control" type="email" name="email" value="<?php echo set_value('email'); ?>" id="email" placeholder="Email" >
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div> 
				</div>

				<?php echo form_error('password'); ?>
				<div class="input-group mb-3">
					<input class="form-control" type="password" name="password" value="<?php echo set_value('password'); ?>" id="password" placeholder="Password" > 
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div> 
				</div>

				<?php echo form_error('repassword'); ?>
				<div class="input-group mb-3">
					<input class="form-control" type="password" name="repassword" value="<?php echo set_value('password'); ?>" id="repassword" placeholder="Repeat Password" > 
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div> 
				</div>
				<div class="row"> 
						
					<?php echo form_error('agree'); ?>
					<div class="col-8">
						<div class="icheck-primary"> 
							<input type="checkbox" id="agree" name="agree" value="1" <?php echo set_checkbox('agree', '1'); ?>>
							<label for="agree">
								I agree to the <a class="text-center" href="<?php echo site_url('access/login'); ?>">Terms and Conditions</a>
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup">Signup</button>	 
					</div>
					<!-- /.col -->
				</div>
			<?php echo form_close(); ?> 

			<!-- /.social-auth-links -->
			<p class="mb-1">
				<a class="text-center" href="<?php echo site_url('access/login'); ?>">Already Have an Account?</a>
			</p>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
