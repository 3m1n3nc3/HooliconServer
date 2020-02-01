<?php $page_title = isset($page_title) ? $page_title  : 'welcome' ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $this->lang->line($page_title) ? $this->lang->line($page_title) : $page_title ?> - <?php echo $this->my_config->item('site_name') ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/fontawesome/css/all.min.css">
		<!-- Ionicons -->
		<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>backend/Ionicons/css/ionicons.min.css"> -->
		<!-- iCheck Bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/icheck/icheck-bootstrap.css"> 
		<!-- Datatables -->
		<?php if (isset($use_table) && $use_table): ?>
  			<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
		<?php endif ?>
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/adminLTE/css/adminlte.min.css"> 
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<!-- jQuery 3 -->
		<script src="<?php echo base_url(); ?>backend/plugins/jquery/jquery.min.js"></script>
	</head>
	<body class="hold-transition sidebar-mini">
		<script type="text/javascript">
			site_url = '<?php echo base_url(); ?>';
		</script>
		<div class="wrapper">

			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="<?php echo site_url() ?>" class="nav-link">Home</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="#" class="nav-link">Contact</a>
					</li>
				</ul>
				<!-- SEARCH FORM -->
				<form class="form-inline ml-3">
					<div class="input-group input-group-sm">
						<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</form>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">  

					<li class="nav-item dropdown user-menu">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo $this->creative_lib->fetch_image($this->account['image']); ?>" class="user-image img-circle elevation-2" alt="User Image">
							<span class="d-none d-md-inline"><?php echo $this->account['name'] ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<!-- User image -->
							<li class="user-header bg-primary">
								<img src="<?php echo $this->creative_lib->fetch_image($this->account['image']); ?>" class="img-circle elevation-2" alt="User Image">
								<p>
									<?php echo $this->account['name'] . ' - ' . $this->account['role'] ?>
									<small><?php echo $this->account['email'] ?></small>
									<small><?php echo $this->account['phone'] ?></small>
								</p>
							</li> 
							<!-- Menu Footer-->
							<li class="user-footer">
								<a href="<?php echo (isset($this->is_admin) ? site_url('admin/admin/update') : site_url('users/account/update')) ?>" class="btn btn-default btn-flat">Settings</a>
								<a href="<?php echo (isset($this->is_admin) ? site_url('admin/admin/logout') : site_url('users/account/logout')) ?>" class="btn btn-default btn-flat float-right">Logout</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
						class="fas fa-th-large"></i></a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="<?php echo site_url() ?>" class="brand-link">
					<img src="<?php echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>" alt="<?php echo $this->my_config->item('site_name') ?> Logo" class="brand-image img-circle elevation-3"
					style="opacity: .8">
					<span class="brand-text font-weight-light"><?php echo $this->my_config->item('site_name') ?></span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
							<img src="<?php echo $this->creative_lib->fetch_image($this->account['image']); ?>" class="img-circle elevation-2" alt="User Image">
						</div>
						<div class="info">
							<?php if (isset($this->is_admin)):?>
								<a href="<?php echo site_url('admin/admin/update/view') ?>" class="d-block"><?php echo $this->account['name'] ?></a>
							<?php else:?>
								<a href="<?php echo site_url('users/account/update/view') ?>" class="d-block"><?php echo $this->account['name'] ?></a>
							<?php endif;?>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
							with font-awesome or any other icon font library -->
							<?php if (isset($this->is_admin) || isset($this->admin_logged_in)): ?>
								<li class="nav-item">
									<a href="<?php echo site_url('admin/admin/dashboard'); ?>" class="nav-link<?php echo ($page_title == 'admin_dashboard' ? ' active' : '') ?>">
										<i class="nav-icon fas fa-tachometer-alt"></i>
										<p> Admin Dashboard </p>
									</a>
								</li>
								<li class="nav-item has-treeview menu-open">
									<a href="#" class="nav-link<?php echo ($page_title == 'configuration' ? ' active' : '') ?>">
										<i class="nav-icon fas fa-wrench"></i>
										<p>
											Configuration
											<i class="right fas fa-angle-left"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">  
										<li class="nav-item">
											<a href="<?php echo site_url('admin/admin/configuration'); ?>" class="nav-link<?php echo (isset($action) && $action == 'configuration' ? ' active' : '') ?>">
												<i class="fa fa-cog nav-icon"></i>
												<p>Main Configuration</p>
											</a>
										</li> 
										<li class="nav-item">
											<a href="<?php echo site_url('admin/admin/configuration/products'); ?>" class="nav-link<?php echo (isset($action) && ($action == 'products' || $action == 'plans') ? ' active' : '') ?>">
												<i class="fa fa-server nav-icon"></i>
												<p>Products and Plans</p>
											</a>
										</li> 
										<li class="nav-item">
											<a href="<?php echo site_url('admin/frontsite'); ?>" class="nav-link<?php echo ($page_title == 'frontsite' ? ' active' : '') ?>">
												<i class="fa fa-home nav-icon"></i>
												<p>Front Site</p>
											</a>
										</li> 
									</ul>
								</li> 
							<?php endif ?>
							<?php 
								if ($page_title == 'active_products' || $page_title == 'add_product') {
									$products_active = ' active';
								} else {
									$products_active = '';
								} 
							?>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link<?php echo $products_active ?>">
									<i class="nav-icon fas fa-th"></i>
									<p>
										Products
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if (isset($this->is_user) || isset($this->user_logged_in)): ?>
										<li class="nav-item">
											<a href="<?php echo site_url('users/product/add'); ?>" class="nav-link<?php echo ($page_title == 'add_product' ? ' active' : '') ?>">
												<i class="fa fa-plus nav-icon"></i>
												<p>Add Product</p>
											</a>
										</li>
									<?php endif ?>
									<li class="nav-item">
										<a href="<?php echo (isset($this->is_admin) ? site_url('admin/admin/listproducts') : site_url('users/product/list')); ?>" class="nav-link<?php echo ($page_title == 'active_products' ? ' active' : '') ?>">
											<i class="fa fa-list nav-icon"></i>
											<p>List Products</p>
										</a>
									</li> 
								</ul>
							</li>
							<?php if (isset($this->is_user) || isset($this->user_logged_in)): ?>
								<li class="nav-item">
									<a href="<?php echo site_url('users/account/payments'); ?>" class="nav-link<?php echo ($page_title == 'payments' ? ' active' : '') ?>">
										<i class="nav-icon fas fa-credit-card"></i>
										<p>
											My Payments 
										</p>
									</a>
								</li>
							<?php endif ?>
							<?php if (isset($this->is_admin) || isset($this->admin_logged_in)): ?>
								<li class="nav-item">
									<a href="<?php echo site_url('admin/admin/listusers'); ?>" class="nav-link<?php echo ($page_title == 'list_users' ? ' active' : '') ?>">
										<i class="nav-icon fas fa-user"></i>
										<p>
											List Users 
										</p>
									</a>
								</li> 
								<li class="nav-item">
									<a href="<?php echo site_url('admin/admin/listpayments'); ?>" class="nav-link<?php echo ($page_title == 'list_payments' ? ' active' : '') ?>">
										<i class="nav-icon fas fa-credit-card"></i>
										<p>
											List Payments
										</p>
									</a>
								</li> 
							<?php endif ?>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>
