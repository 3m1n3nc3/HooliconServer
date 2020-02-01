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
					<p> <div><?php echo $product['description'] ?></div> </p>  
					<p>Choose a suitable plan to continue</p>
					
					<div class="row">
						<?php $i = 1; ?>
						<?php foreach ($plans as $plan): ?>   
							<div class="col-md-6">
								<!-- small card -->
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo $this->cr_symbol.$plan['price'] ?></h3>
										<p><?php echo $plan['title'] ?></p>
									</div>
									<div class="icon">
										<i class="fas fa-shopping-cart"></i>
									</div>
									<a href="<?php echo site_url('users/product/payment/'.$product['id'].'/'.$plan['id']) ?>" class="small-box-footer">
										Select Plan  <i class="fas fa-arrow-circle-right"></i>
									</a>
								</div>
							</div>  
						<?php endforeach ?>
					</div>
 
				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
