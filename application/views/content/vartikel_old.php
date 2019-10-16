    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Artikel</span>
        </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
        <div class="container2">
          <div class="row">

            <div class="col-md-8">

              <?php
              foreach ($articles as $post) {
                  $path = parseDateTime($post['c_created_date']);
                  $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];

                  $date = parseDateTime($post['c_publish_date']);
                  $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                  $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
              ?>
              <div class="berita-single"><!--Single Berita-->
                  <div class="row">
                      <div class="col-lg-3"><!--Berita Thumbnails-->
                          <a href="<?php echo $b_url; ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo $post['c_title']; ?>" onError="this.src='<?php echo images_uri(); ?>logo-big.png'"></a>
                      </div>
                      <div class="col-lg-9"><!--Berita Caption-->
                          <a href="<?php echo $b_url; ?>"><p class="berita-title"><?php echo stripslashes($post['c_title']); ?></p></a>
                          <p class="berita-date"> <?php echo $showdate; ?></p>
                          <p class="berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p>
                          <br/>
                          <a href="<?php echo $b_url; ?>"><img src="<?php echo $this->config->item('template_uri');?>img/selengkapnya.jpg"></a>
                      </div>

                  </div>
              </div><!--//Single Berita-->
              <?php } ?>

              <center>
                  <?php echo $pagination; ?>
              </center>

            </div>

            <div class="col-md-4 berita-video-foto">

              <div class="about-side-nav-wrap">

                <div class="side-choy-wrap">
                  <div class="side-choy">
                    <img src="<?php echo $this->config->item('template_uri');?>img/choy2.gif" />
                  </div>
                </div>
                <br/>

                <div class="home-video">
                  <h4 class="title">Video</h4>
                  <a href="#" style="color: #a5a5a5" class="more-btn-right">[more]</a>

                  <?php
                    foreach ($video as $post) {
                        $path  = parseDateTime($post['c_created_date']);
                        $url   = base_url() . 'video/read/'. $path['year'].$path['month'] .$path['day'] .'/'. $post['c_id'] .'/'. $post['c_slug'];
                        $image = $this->config->item('images_posts_uri') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $post['c_id'] .'/'. $post['c_images_thumbnail'];

                        ?>
                            <a href="galeri-video.html">
                              <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                  <div class="galeri-thumbnail-veil">
                                      <!-- <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i> -->
                                      <img class="play" src="<?php echo $this->config->item('template_uri');?>img/play-btn.png" />
                                  </div>
                                  <img src="<?php echo $image; ?>">
                              </div><!--//Galeri Thumbnail-->
                            </a>
                            <a href="#" style="color:#316fc4;"><p style="margin-top:5px"><?php echo $post['c_title']; ?></p></a>
                        <?php
                    }
                  ?>

                </div>
                <br/>


                <div class="home-video">
                  <h4 class="title">Foto</h4>
                  <a href="#" style="color: #a5a5a5" class="more-btn-right">[more]</a>

                  <div class="row">

                    <?php
                      $total = 2;
                      if($foto > 0) {
                          $no = 1;
                          for($i=0; $i < $total; $i++){
                              $photo          = $foto[$i];
                              $path           = parseDateTime($photo['album_created_date']);
                              $image          = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images'];
                              $image_thumb    = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images_thumbnail'];
                              $url   = base_url(). 'foto/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];
                              $cls = "";
                              if($no==1) {
                                  $cls = "active";
                              }
                              ?>
                              
                              <div class="col-xs-6">
                                <a href="<?php echo $url; ?>">
                                  <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                    <div class="galeri-thumbnail-veil">
                                      <i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                                      <p><?php echo $jumlah_foto; ?></p>
                                    </div>
                                    <img src="<?php echo $image;?>">

                                  </div><!--//Galeri Thumbnail-->
                                </a>

                                <a href="<?php echo $url; ?>"><p style="margin-top:5px"><?php echo $photo['ph_title']?></p></a>
                              </div>
                          <?php
                          $no++;
                          }
                      }
                    ?>

                  </div>


                </div>

              </div>

            </div>
        </div>
    </div><!--//Main content-->
