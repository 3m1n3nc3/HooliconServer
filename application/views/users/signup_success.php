	<a href="<?php echo site_url('users/account') ?>">My Account</a>

			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small><?php echo ucfirst($name) ?></small>
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
					<div class="card">
						<div class="card-body">

							<p><?php echo $this->session->flashdata('msg') ?></p>     

							<br>   
							<hr> 
						
							<a class="btn btn-warning" href="<?php echo site_url('users/account') ?>">
								<i class="far fa-user"></i>
								My Account
							</a> 

						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
