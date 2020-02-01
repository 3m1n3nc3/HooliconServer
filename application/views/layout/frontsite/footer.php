    <!-- Bottom widget -->
    <section id="bottom-widget" class="home-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="contact-widget wow bounceInLeft">
              <i class="fa fa-map-marker fa-4x"></i>
              <h5>Main Office</h5>
              <p>
                <?php echo $this->my_config->item('contact_address'); ?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-widget wow bounceInUp">
              <i class="fa fa-phone fa-4x"></i>
              <h5>Call</h5>
              <p>
                <?php echo $this->my_config->item('contact_phone'); ?>

              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-widget wow bounceInRight">
              <i class="fa fa-envelope fa-4x"></i>
              <h5>Email us</h5>
              <p>
                <?php echo $this->my_config->item('contact_email'); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="row mar-top30">
          <div class="col-md-12">
            <h5>We're on social networks</h5>
            <ul class="social-network">
              <li><a href="<?php echo $this->my_config->item('contact_facebook'); ?>">
                  <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span></a>
              </li> 
              <li><a href="<?php echo $this->my_config->item('contact_twitter'); ?>">
                  <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span></a>
              </li>
              <li><a href="<?php echo $this->my_config->item('contact_instagram'); ?>">
                  <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                  </span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo $this->my_config->item('site_name'); ?>. All rights reserved.</p>
            <div class="credits"> 
              Designed with love
              <p>
                <?php if (isset($this->admin_logged_in)): ?>
                  <a href="<?php echo site_url('admin/admin/dashboard'); ?>"><i class="fa fa-user-secret"></i> Admin</a>
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- js -->
    <script src="<?php echo base_url(); ?>backend/frontsite/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/jquery.nav.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/modernizr.custom.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/grid.js"></script>
    <script src="<?php echo base_url(); ?>backend/frontsite/js/stellar.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="<?php echo base_url(); ?>backend/frontsite/contactform/contactform.js"></script>

    <!-- Template Custom Javascript File -->
    <script src="<?php echo base_url(); ?>backend/frontsite/js/custom.js"></script>

  </body>

</html>
