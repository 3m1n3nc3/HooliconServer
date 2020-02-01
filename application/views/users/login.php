<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo site_url('') ?>"><?php echo $this->my_config->item('site_name') ?></a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to access your products</p>
			<p><?php echo $this->session->flashdata('msg') ?></p>
			<?php echo form_open('access/login/'.$action); ?>
				
				<?php echo form_error('username'); ?>
				<div class="input-group mb-3"> 
					<input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" id="username" placeholder="Username or Email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
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
				<div class="row">
					<div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember" name="remember" value="1" <?php echo set_checkbox('remember', '1'); ?>>
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			<?php echo form_close(); ?> 

			<!-- /.social-auth-links -->
			<p class="mb-1">
				<a class="text-center" href="<?php echo site_url('access/signup'); ?>">Forgot Password</a>
			</p>
			<p class="mb-0">
				<a class="text-center" href="<?php echo site_url('access/signup'); ?>">Dont have an Account?</a>
			</p>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
