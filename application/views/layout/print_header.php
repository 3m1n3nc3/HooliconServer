<?php $page_title = isset($page_title) ? $page_title  : 'welcome' ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $this->lang->line($page_title) ? $this->lang->line($page_title) : $page_title ?> - <?php echo $this->my_config->item('site_name') ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/fontawesome/css/all.min.css">   
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>backend/adminLTE/css/adminlte.min.css"> 
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
	</head>
	<body>
		<script type="text/javascript">
			site_url = '<?php echo base_url(); ?>';
		</script>
		<div class="wrapper">
