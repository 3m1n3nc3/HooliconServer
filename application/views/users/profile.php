			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $this->lang->line($page_title) ?>
						<small><?php echo $fullname ?></small>
					</h1> 
				</section>
				<!-- Main content -->
				<section class="content"> 
					
					<p><?php echo $this->session->flashdata('msg') ?></p> 
					 
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle"
								src="<?php echo $this->creative_lib->fetch_image($this->account['image']); ?>"
								alt="User profile picture">
							</div>
							<h3 class="profile-username text-center"><?php echo $fullname ?></h3>
							<p class="text-muted text-center"><?php echo ucwords($role) ?></p>
							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Email</b> <a class="float-right"><?php echo $email ?></a>
								</li>
								<li class="list-group-item">
									<b>Phone</b> <a class="float-right"><?php echo $phone ?></a>
								</li> 
								<li class="list-group-item">
									<b>Products</b> <a class="float-right"><?php echo count($product_) ?></a>
								</li>
								<li class="list-group-item">
									<b>Payments</b> <a class="float-right"><?php echo count($payments) ?></a>
								</li> 
							</ul>
							<?php if (isset($this->is_admin)): ?>
								<a href="<?php echo site_url('admin/admin/viewuser/'.$id.'/update') ?>" class="btn btn-primary btn-block"><b>Update</b></a>
							<?php endif; ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->  					

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
