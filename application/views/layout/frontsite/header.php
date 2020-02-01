<?php $page_title = isset($page_title) ? $page_title  : 'welcome' ?>
<!DOCTYPE html>
<html>

  <head>
    <title><?php echo $this->lang->line($page_title) ? $this->lang->line($page_title) : $page_title ?> - <?php echo $this->my_config->item('site_name') ?></title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">

    <link href="<?php echo base_url(); ?>backend/frontsite/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>backend/frontsite/css/style.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>backend/frontsite/color/default.css" rel="stylesheet" media="screen"> 
    <style type="text/css">
      <?php if (isset($parallax_one)): ?>
        #parallax1 {
            background-image: url(<?php echo $this->creative_lib->fetch_image($parallax_one); ?>);
        }        
      <?php endif; ?>
    </style>
  </head>

  <body>
    <script type="text/javascript">
      site_url = '<?php echo base_url(); ?>';
      fix_nav = <?php echo (isset($fix_nav) ? 1 : 0) ?>;
    </script>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle nav</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Logo text or image -->
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php  echo $this->creative_lib->fetch_image($this->my_config->item('site_logo')) ?>" style="max-height: 50px;"></a>

        </div>
        <div class="navigation collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li class="current"><a href="#intro">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#portfolio">Products</a></li>
            <li><a href="#team">Team</a></li>
            <li><a href="#contact">Contact</a></li>
            <li>
            <?php if ($this->session->has_userdata('username')): ?>
              <a href="<?php echo site_url('users/account'); ?>">My Account</a>
            <?php else: ?>
              <a href="<?php echo site_url('access/login'); ?>">Login</a>
            <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
