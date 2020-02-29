<?php $page_title = isset($page_title) ? $page_title  : 'welcome' ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $this->lang->line($page_title) ?> - <?php echo $this->my_config->item('site_name') ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/fontawesome/css/all.min.css"> 
		<!-- iCheck Bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/icheck/icheck-bootstrap.css"> 
		<!-- Datatables -->
		<?php if (isset($use_table) && $use_table): ?>
  			<link rel="stylesheet" href="<?php echo base_url(); ?>backend/datatables/css/dataTables.bootstrap.min.css">
		<?php endif ?>
		<!-- Theme style --> 
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/adminLTE/css/adminlte.min.css">  
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <link rel="shortcut icon" href="<?php echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>" type="image/x-icon" />
	</head>
	<body class="hold-transition login-page">
