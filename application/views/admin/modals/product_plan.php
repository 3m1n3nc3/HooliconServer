					<div class="row"> 
						<?php if ($action == 'plans'): ?>  
							<?php foreach ($plans as $plan): ?>   
								<div class="col-md-3"> 
									<!-- small card -->
									<div class="small-box bg-info">
										<div class="inner">
											<h3><?php echo $this->cr_symbol.$plan['price']?></h3>
											<p> <?php echo $plan['title'] ?> </p>
										</div>
										<div class="icon">
											<i class="fas fa-gift"></i>
										</div>
										<a href="<?php echo site_url('admin/admin/configuration/plans/'.$plan['id']) ?>" class="small-box-footer">
											Edit Plan  <i class="far fa-edit"></i>
										</a>
									</div>
								</div>  
							<?php endforeach ?>
						<?php elseif ($action == 'products'): ?>  
							<?php foreach ($products as $product): ?>   
								<div class="col-md-4">
									<!-- small card -->
									<div class="small-box bg-info">
										<div class="inner">
											<h4><?php echo $product['title'] ?></h4>
											<p> <?php echo $product['title'] ?> </p>
										</div>
										<div class="icon">
											<i class="fas fa-server"></i>
										</div>
										<a href="<?php echo site_url('admin/admin/configuration/products/'.$product['id']) ?>" class="small-box-footer">
											Edit Product  <i class="far fa-edit"></i>
										</a>
									</div>
								</div>  
							<?php endforeach ?>
						<?php endif ?>
					</div>
