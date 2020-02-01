			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $this->lang->line('admin') ?>
						<small><?php echo $this->lang->line($page_title) ?></small>
					</h1> 
				</section>
				<!-- Main content -->
				<section class="content"> 
					
					<p><?php echo $this->session->flashdata('msg') ?></p> 
					 
                    <?php if (isset($error) && $error != '') { ?>
                        <?php if (is_array($error)): ?>
                            <?php foreach ($error as $error_k => $error_m): ?>
                                <div class="alert alert-danger text-left">
                                    <?php echo $error_m; ?>
                                </div>
                            <?php endforeach?>
                        <?php else: ?>
                            <div class="alert alert-danger text-left">
                                <?php echo $error; ?>
                            </div>
                        <?php endif?>
                    <?php } ?>
					 
					<div class="card card-primary">
						<div class="card-header with-border">
							<h3 class="card-title"><?php echo $this->lang->line('propagate') . ' ' . ($action == 'email' ? $site_email : $site_url) ?></h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<?php echo form_open('admin/operation/manual_propagation/'.$product_id.($action ? '/'.$action : '')); ?> 
							<div class="card-body">
								<div class="row">
									<?php if ($action == 'email'): ?>
										<div class="col-md-6 form-group">  
											<label for="email"> Email Address:</label>
											<input class="form-control" type="text" name="email" value="<?php echo set_value('email') ? set_value('email') : $prop_email ?>" id="email">
											<?php echo form_error('name'); ?>
										</div>
									<?php else: ?>
										<div class="col-md-6 form-group">  
											<label for="domain"> Sub Domain Name:</label>
											<input class="form-control" type="text" name="domain" value="<?php echo set_value('domain') ? set_value('domain') : $prop_url ?>" id="domain">
											<?php echo form_error('name'); ?>
										</div>
										<div class="col-8">
											<div class="icheck-primary"> 
												<input type="checkbox" id="gen_email" name="gen_email" value="1" <?php echo set_checkbox('gen_email', '1'); ?>>
												<label for="gen_email"> Also generate Email Account</label>
											</div>
										</div>
									<?php endif; ?>
								</div> 
								<small class="pb-5">
									This product will be updated with new value after propagation.
								</small>  
							</div>
							<!-- /.box-body -->
							<div class="card-footer">  
								<button class="btn btn-success" type="submit" name="save">Propagate</button> 
								<a class="btn btn-primary" href="<?php echo site_url('admin/admin/product/'.$product_id.'/update') ?>">
									Update Product
								</a>
							</div>
						<?php echo form_close(); ?> 
					</div>
					<!-- /.box -->				

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper -->
