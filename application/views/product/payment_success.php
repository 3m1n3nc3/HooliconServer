			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small>Invoice</small>
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

							<?php echo $load_invoice ?>
							<hr>

							<h3><?php echo $plan['title'] ?> <?php echo $product['title'] ?></h3> 
							<br>   
						
							<a class="btn btn-warning" href="<?php echo site_url('users/account') ?>">
								<i class="far fa-user"></i>
								My Account
							</a>
							<a class="btn btn-primary" href="<?php echo site_url('users/product/setup/'.$payment_id) ?>">
								<i class="fa fa-wrench"></i>
								Setup Product
							</a>

						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
