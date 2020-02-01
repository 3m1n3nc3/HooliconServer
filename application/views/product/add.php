			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line($page_title) ?>
									<small><?php echo $user['name'] ?></small>
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
					<p>Choose a product and proceed to payment</p>
					
					<div class="row">
						<?php $i = 1; ?>
						<?php foreach ($products as $product): ?>   
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><?php echo $product['title'] ?></h3>
									</div>
									<div class="card-body">
										<?php echo $product['description'] ?>
									</div>
									<div class="card-footer">
										<a href="<?php echo site_url('users/product/plan/'.$product['id']) ?>" class="small-box-footer">
					             			Select Product <i class="fa fa-arrow-circle-right"></i>
					            		</a>
									</div> 
								</div> 
							</div>  
						<?php endforeach ?>
					</div>
 
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
