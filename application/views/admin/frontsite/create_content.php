			<div class="content-wrapper mb-5">
				<!-- Content Header (Page header) --> 
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>
									<?php echo $this->lang->line('admin') ?>
									<small>Create Content</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Create Content</li>
								</ol>
							</div>
						</div>
					</div>
				</section>

				<!-- Main content -->
				<section class="content">  
					
					<a href="<?php echo site_url('admin/frontsite/add_content') ?>" class="btn btn-primary btn-lg my-2">Create new Content</a>
					<hr>

					<p><?php echo $this->session->flashdata('msg') ?></p> 

					<div class="row"> 

						<div class="col-md-8">
							<?php echo form_open_multipart('admin/frontsite/add_content'.(isset($id) ? '/'.$id : '')); ?>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Create Content</h3>
									</div>
									<div class="card-body"> 

										<div class="row"> 
											<div class="col-md-12 form-group">   
												<label class="custom-file-label" for="content_image">Choose Image</label>
												<input type="file" name="content_image" class="custom-file-input" id="content_image">
												<small class="text-muted">Select the image to add with this content</small>
												<?php echo isset($upload_error) ? $upload_error : ''; ?>
											</div> 
										</div>
										<hr>
										<div class="row">   

											<div class="col-md-6 form-group">  
												<label for="title">Title</label>
												<input type="text" name="value[title]" value="<?php echo (set_value('value[title]') ? set_value('value[title]') : (isset($title) ? $title : '')); ?>" class="form-control" >
												<small class="text-muted">The main title for this content</small>
												<?php echo form_error('value[title]'); ?>
											</div>   

											<div class="col-md-6 form-group">  
												<label for="subtitle">Subtitle</label>
												<input type="text" name="value[subtitle]" value="<?php echo (set_value('value[subtitle]') ? set_value('value[subtitle]') :  (isset($subtitle) ? $subtitle : '')); ?>" class="form-control" >
												<small class="text-muted">The subtitle for this content</small>
												<?php echo form_error('value[subtitle]'); ?>
											</div>   

											<div class="col-md-6 form-group">  
												<label for="type">Type</label>
												<select name="value[type]" class="form-control" > 
													<option value="main_slides"<?php echo set_select('value[type]', 'main_slides', TRUE); ?>>Main Carousel Slides</option>
													<option value="about"<?php echo set_select('value[type]', 'about'); ?>>About Us</option>
													<option value="parallax"<?php echo set_select('value[type]', 'parallax'); ?>>Parallax Banner</option>
													<option value="services"<?php echo set_select('value[type]', 'services'); ?>>Our Services</option>
													<option value="products"<?php echo set_select('value[type]', 'products'); ?>>Products</option>
													<option value="partners"<?php echo set_select('value[type]', 'partners'); ?>>Partners</option>
													<option value="team"<?php echo set_select('value[type]', 'team'); ?>>Team</option>
												</select>
												<small class="text-muted">The type of content this is will determine where it gets to be displayed</small>
												<?php echo form_error('value[type]'); ?>
											</div>  

											<div class="col-md-6 form-group">  
												<label for="type">Icon</label>
												<select name="value[icon]" class="form-control" >
				 									<?php echo $this->intl->icon(1, (set_value('value[icon]') ? set_value('value[icon]') : isset($icon) ? $icon : '')) ?>
												</select>
												<small class="text-muted">The icon will be displayed along side the title when and where relevant</small>
												<?php echo form_error('value[icon]'); ?>
											</div> 

											<div class="col-md-12 form-group">  
												<label for="link">Link url</label>
												<input type="text" name="value[link]" value="<?php echo (set_value('value[link]') ? set_value('value[link]') :  (isset($link) ? $link : '')); ?>" class="form-control" >
												<small class="text-muted">A link where viewer can see full details ( enter "1" if you want system to auto generate link)</small>
												<?php echo form_error('value[link]'); ?>
											</div>   

											<div class="col-md-12 form-group">  
												<label for="type">Introduction</label>
												<textarea name="value[content]" class="form-control" ><?php echo set_value('value[content]') ? set_value('value[content]') :  (isset($content) ? $content : '')?></textarea>
												<small class="text-muted">A brief introduction of this content</small>
												<?php echo form_error('value[content]'); ?>
											</div>  

											<div class="col-md-12 form-group">  
												<label for="type">Details</label>
												<textarea name="value[details]" class="form-control" ><?php echo set_value('value[details]') ? set_value('value[details]') :  (isset($details) ? $details : '')?></textarea>
												<small class="text-muted">The main details of this content</small>
												<?php echo form_error('value[details]'); ?>
											</div>     

										</div>  

									</div>
									<!-- /.box-body -->
									<div class="card-footer">  
										<button class="btn btn-flat btn-success" type="submit" name="save"><?php echo isset($id) ? 'Update Content': 'Create Content' ?></button>
									</div>		 
								</div>
							<?php echo form_close(); ?> 	

						</div> 

						<div class="col-md-4">
							<?php echo form_open('admin/frontsite/add_content'.(isset($id) ? '/'.$id : '/set').'/section'); ?>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Content Sections</h3>
									</div> 
									<div class="card-body">
										
										<div class="form-group">  
											<label for="link">Section Title</label>
											<input type="text" name="val[title]" value="<?php echo (set_value('val[title]') ? set_value('val[title]') :  (isset($section) ? $section['title'] : '')); ?>" class="form-control" > 
											<?php echo form_error('val[title]'); ?>
										</div>   

										<div class="form-group">  
											<label for="type">Introduction</label>
											<textarea name="val[content]" class="form-control" ><?php echo set_value('val[content]') ? set_value('val[content]') :  (isset($section) ? $section['content'] : '')?></textarea> 
											<?php echo form_error('val[content]'); ?>
										</div> 
									</div>
									<!-- /.box-body -->
									<div class="card-footer">  
										<button class="btn btn-flat btn-success" type="submit" name="save"><?php echo isset($section) ? 'Update Section': 'Create Section' ?></button>
									</div>	
								</div>
							<?php echo form_close(); ?> 

							<?php echo form_open('admin/frontsite/add_content/set/contact'); ?>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Contact Information</h3>
									</div> 
									<div class="card-body">
										
										<div class="form-group">  
											<label for="link">Email</label>
											<input type="text" name="contact[contact_email]" value="<?php echo set_value('contact[contact_email]') ? set_value('contact[contact_email]') : $this->my_config->item('contact_email'); ?>" class="form-control" > 
											<?php echo form_error('contact[contact_email]'); ?>
										</div>    
										
										<div class="form-group">  
											<label for="link">Phone</label>
											<input type="text" name="contact[contact_phone]" value="<?php echo set_value('contact[contact_phone]') ? set_value('contact[contact_phone]') : $this->my_config->item('contact_phone'); ?>" class="form-control" > 
											<?php echo form_error('contact[contact_phone]'); ?>
										</div>   
										
										<div class="form-group">  
											<label for="link">Facebook</label>
											<input type="text" name="contact[contact_facebook]" value="<?php echo set_value('contact[contact_facebook]') ? set_value('contact[contact_facebook]') : $this->my_config->item('contact_facebook'); ?>" class="form-control" > 
											<?php echo form_error('contact[contact_facebook]'); ?>
										</div>   
										
										<div class="form-group">  
											<label for="link">Twitter</label>
											<input type="text" name="contact[contact_twitter]" value="<?php echo set_value('contact[contact_twitter]') ? set_value('contact[contact_twitter]') : $this->my_config->item('contact_twitter'); ?>" class="form-control" > 
											<?php echo form_error('contact[contact_twitter]'); ?>
										</div>    
										
										<div class="form-group">  
											<label for="link">Instagram</label>
											<input type="text" name="contact[contact_instagram]" value="<?php echo set_value('contact[contact_instagram]') ? set_value('contact[contact_instagram]') : $this->my_config->item('contact_instagram'); ?>" class="form-control" > 
											<?php echo form_error('contact[contact_instagram]'); ?>
										</div>    
										
										<div class="form-group">  
											<label for="type">Address</label>
											<textarea name="contact[contact_address]" class="form-control" ><?php echo set_value('contact[contact_address]') ? set_value('contact[contact_address]') : $this->my_config->item('contact_address'); ?></textarea> 
											<?php echo form_error('contact[contact_address]'); ?>
										</div>  
									</div>
									<!-- /.box-body -->
									<div class="card-footer">  
										<button class="btn btn-flat btn-success" type="submit" name="save"> Update Contact Info </button>
									</div>	
								</div>
							<?php echo form_close(); ?> 
						</div>
					</div> 

				</section>
				<!-- /.content -->

			</div>
			<!-- /.content-wrapper --> 
