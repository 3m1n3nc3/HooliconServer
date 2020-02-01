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
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/adminLTE/css/adminlte.min.css"> 
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition layout-top-nav">
		<script type="text/javascript">
			site_url = '<?php echo base_url(); ?>';
		</script>
		<div class="wrapper">

			<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
				<div class="container">
					<a href="<?php echo base_url() ?>" class="navbar-brand">
						<img src="<?php echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>" alt="<?php echo $this->my_config->item('site_name') ?> Logo" class="brand-image img-circle elevation-3"
						style="opacity: .8">
						<span class="brand-text font-weight-light"><?php echo $this->my_config->item('site_name') ?></span>
					</a>
	 				
					<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse order-3" id="navbarCollapse">
						<!-- Left navbar links -->
						<ul class="navbar-nav">
							<li class="nav-item">
								<a href="<?php echo base_url() ?>" class="nav-link">Home</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">Contact</a>
							</li> 
						</ul> 
					</div> 
				</div>
			</nav>
			<!-- /.navbar -->




























 
