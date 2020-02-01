    <!-- About -->
    <?php if (isset($content)): ?>
      <section id="about" class="home-section bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <div class="section-heading">
                <h2><?php  echo $content['title'] ?></h2>
                <div class="heading-line"></div>
                <p><?php  echo $content['subtitle'] ?></p>
              </div>
            </div>
          </div>
          <div class="row wow fadeInUp">
            <div class="col-md-6 about-img">
              <img src="<?php echo $this->creative_lib->fetch_image($content['image']) ?>" alt="<?php  echo $content['title'] ?> image">
            </div>

            <div class="col-md-6 content">
              <h2><?php  echo $content['content'] ?></h2> 
              <p>
                <?php  echo $content['details'] ?>
              </p>
            </div>
          </div>
        </div>
      </section>
      <hr>
    <?php endif; ?> 
