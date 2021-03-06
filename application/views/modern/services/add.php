		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- /.col-md-6 Important Shortcuts -->
					<div class="col-lg-12">

            			<?= $this->session->flashdata('message') ?? '' ?>

						<div class="card">
							<div class="card-header">
								<strong class="m-0 p-0">
								<i class="fa fa-plus mx-2 text-gray"></i>
								Add Services
								</strong>
								<div class="float-right d-none d-sm-inline text-sm my-0 p-0">
									<?//= $pagination ?>
								</div>
							</div>
							<div class="card-body">
								<?= form_open('services/add') ?>
								<div class="row">
									<div class="col-md-6">
										<!-- text input -->
										<div class="form-group">
											<label for="serviceName">Service Name</label>
											<input type="text" id="serviceName" name="ServiceName" class="form-control" placeholder="Service Name" value="<?= set_value('ServiceName') ?>" required>
											<?= form_error('serviceName'); ?>
										</div>
									</div>
									<div class="col-md-6">
										<!-- text input -->
										<div class="form-group">
											<label for="tableCount">Table Count</label>
											<input type="tableCount" id="tableCount" name="tableCount" class="form-control" value="<?= set_value('tableCount') ?>">
											<?= form_error('tableCount'); ?>
										</div>
									</div>
									<div class="col-md-6">
										<!-- text input -->
										<div class="form-group">
											<label for="ServiceOpenTime">Service Open Time</label>
											<input type="time" id="ServiceOpenTime" name="ServiceOpenTime" class="form-control" value="<?= set_value('ServiceOpenTime') ?>" placeholder="Service Open Time" required>
											<?= form_error('ServiceOpenTime'); ?>
										</div>
									</div>
									<div class="col-md-6">
										<!-- text input -->
										<div class="form-group">
											<label for="ServiceCloseTime">Service Close Time</label>
											<input type="time" id="ServiceCloseTime" name="ServiceCloseTime" class="form-control" value="<?= set_value('ServiceCloseTime') ?>" placeholder="Service Close Time" required>
											<?= form_error('ServiceCloseTime'); ?>
										</div>
									</div>
									<div class="col-md-12">
										<!-- text input -->
										<div class="form-group">
											<label for="price">Service Details</label>
											<textarea type="text" id="ServiceDetails" name="ServiceDetails" class="form-control" placeholder="Service Details"><?= set_value('ServiceDetails') ?></textarea>
											<?= form_error('ServiceDetails'); ?>
										</div>
									</div>
									<button class="btn btn-success">Add</button>
								</div>
								<?= form_close() ?>
							</div>
						</div>
					</div>
				</div>
			<!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
