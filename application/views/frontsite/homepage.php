    <!-- intro area -->
    <?php if (count($slides)>0): ?>
      <section id="intro">
        <div class="intro-container">
          <div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">

            <div class="carousel-inner" role="listbox">

              <!-- Slides -->
              <?php $i = 0 ?>
              <?php foreach ($slides as $slide): ?>
                <?php $i++ ?>
                <div class="item<?php echo ($i == 1 ? ' active' : '') ?>">
                  <div class="carousel-background"><img src="<?php echo $this->creative_lib->fetch_image($slide['image']) ?>" alt=""></div>
                  <div class="carousel-container">
                    <div class="carousel-content">
                      <h2 class="animated fadeInDown"><?php  echo $slide['title'] ?></h2>
                      <p class="animated fadeInUp"><?php  echo $slide['content'] ?></p>
                      <?php if (filter_var($slide['link'], FILTER_VALIDATE_URL) || $slide['link'] == 1): ?>
                        <a href="<?php echo $slide['link'] == 1 ? site_url('welcome/details/'.$slide['id']) : $slide['link'] ?>" class="btn-get-started animated fadeInUp">Read More</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div> 
              <?php endforeach; ?>

            </div>

            <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon fa fa-angle-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon fa fa-angle-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>
      </section> 
    <?php endif; ?>

    <!-- About -->
    <?php if (isset($about)): ?>
      <section id="about" class="home-section bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <div class="section-heading">
                <h2><?php  echo $about['title'] ?></h2>
                <div class="heading-line"></div>
                <p><?php  echo $about['subtitle'] ?></p>
              </div>
            </div>
          </div>
          <div class="row wow fadeInUp">
            <div class="col-md-6 about-img">
              <img src="<?php echo $this->creative_lib->fetch_image($about['image']) ?>" alt="<?php  echo $about['title'] ?> image">
            </div>

            <div class="col-md-6 content">
              <h2><?php  echo $about['content'] ?></h2> 
              <p>
                <?php  echo $about['details'] ?>
              </p>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Parallax 1 -->
    <?php if (isset($parallax)): ?>
      <section id="parallax1" class="home-section parallax" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="color-light">
                <h2 class="wow bounceInDown" data-wow-delay="0.5s"><?php  echo $parallax['title'] ?></h2>
                <p class="lead wow bounceInUp" data-wow-delay="1s"><?php  echo $parallax['subtitle'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Services -->
    <?php if (count($services)>0): ?>
      <section id="services" class="home-section bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <div class="section-heading">
                <h2><?php echo $this->creative_lib->get_section('services', 'title') ?></h2>
                <div class="heading-line"></div>
                <p><?php echo $this->creative_lib->get_section('services', 'content') ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="carousel-service" class="service carousel slide">

                <!-- slides -->
                <div class="carousel-inner">
                  <?php $i = 0 ?>
                  <?php foreach ($services as $service): ?>
                    <?php $i++ ?>
                    <div class="item<?php echo ($i == 1 ? ' active' : '') ?>">
                      <div class="row">
                        <div class="col-sm-12 col-md-offset-1 col-md-6">
                          <div class="wow bounceInLeft">
                            <h4><?php  echo $service['title'] ?></h4>
                            <p><?php  echo $service['content'] ?></p>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                          <div class="screenshot wow bounceInRight">
                            <img src="<?php echo $this->creative_lib->fetch_image($service['image']) ?>" class="img-responsive" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>  
                  <?php endforeach; ?>
                </div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $i = 0; ?>
                  <?php foreach ($services as $service): ?>
                    <?php $i++ ?>
                    <li data-target="#carousel-service" data-slide-to="<?php echo $i-1 ?>"<?php echo ($i == 1 ? ' class="active"' : '') ?>></li> 
                  <?php endforeach; ?>
                </ol>

              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Works -->
    <?php if (isset($products)): ?>
      <section id="portfolio" class="home-section bg-gray">
        <div class="container">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <div class="section-heading">
                <h2><?php echo $this->creative_lib->get_section('products', 'title') ?></h2>
                <div class="heading-line"></div>
                <p><?php echo $this->creative_lib->get_section('products', 'content') ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">

              <ul id="og-grid" class="og-grid">
                <?php foreach ($products as $product): ?>
                  <li>
                    <a href="<?php echo $product['link'] == 1 ? site_url('welcome/details/'.$product['id']) : $product['link'] ?>" data-largesrc="<?php  echo $this->creative_lib->fetch_image($product['image']) ?>" data-title="<?php  echo $product['title'] ?>" data-description="<?php  echo $product['content'] ?>">
                      <img src="<?php  echo $this->creative_lib->fetch_image($product['image']) ?>" alt="" style="max-height: 250px; max-width: 250px"/>
                    </a>
                  </li>   
                <?php endforeach; ?>
              </ul>

            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Parallax 2 -->
    <?php if (isset($partners)): ?>
      <section id="parallax2" class="home-section parallax" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <ul class="clients">
                <?php $i = 1 ?>
                <?php foreach ($partners as $partner): ?>
                  <?php $i = $i+2; $ix = $i/100*10; ?>
                    <li class="wow fadeInDown" data-wow-delay="<?php echo $ix-0.2 ?>s">
                      <a href="<?php echo $partner['link'] == 1 ? site_url('welcome/details/'.$partner['id']) : $partner['link'] ?>">
                        <img src="<?php  echo $this->creative_lib->fetch_image($partner['image']) ?>" alt="" style="max-height: 50px;" />
                      </a>
                    </li> 
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Team -->
    <?php if (isset($team)): ?>
      <section id="team" class="home-section bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <div class="section-heading">
                <h2><?php echo $this->creative_lib->get_section('team', 'title') ?></h2>
                <div class="heading-line"></div>
                <p><?php echo $this->creative_lib->get_section('team', 'content') ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <?php $i = 1 ?>
            <?php foreach ($team as $team_): ?>
              <?php $i = $i+2; $ix = $i/100*10; ?>
              <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a href="<?php  echo $team_['link'] ? $team_['link'] : site_url('welcome/details/'.$team_['id']) ?>"> 
                  <div class="box-team wow bounceInUp" data-wow-delay="<?php echo $ix-0.2 ?>s">
                    <img src="<?php  echo $this->creative_lib->fetch_image($team_['image']) ?>" alt="" class="img-circle img-responsive" />
                    <h4><?php  echo $team_['title'] ?></h4>
                    <p><?php  echo $team_['subtitle'] ?></p>
                  </div>
                </a>
              </div>
            <?php endforeach; ?> 
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Contact -->
    <section id="contact" class="home-section bg-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-offset-2 col-md-8">
            <div class="section-heading">
              <h2><?php echo $this->creative_lib->get_section('contact', 'title') ?></h2>
              <div class="heading-line"></div>
              <p><?php echo $this->creative_lib->get_section('contact', 'content') ?></p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-offset-2 col-md-8">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>

            <form action="" method="post" class="form-horizontal contactForm" role="form">
              <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4"
                    data-msg="Please enter at least 4 chars">
                  <div class="validation"></div>
                </div>
              </div>

              <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email"
                    data-msg="Please enter a valid email">
                  <div class="validation"></div>
                </div>
              </div>

              <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4"
                    data-msg="Please enter at least 8 chars of subject">
                  <div class="validation"></div>
                </div>
              </div>

              <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us"
                    placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                  <button type="submit" class="btn btn-theme btn-lg btn-block">Send message</button>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </section> 
