        <?php 
          foreach ($testimoni as $key) {
            $date = parseDateTime($key['testimoni_created']);
            $showdate = $date['day_ind_name']. ' | '.$date['day'].' '.$date['month_ind_name'].' '.$date['year'];
            $img = $this->config->item('images_testi_uri') . $key['testimoni_id'] .'/'.$key['testimoni_image'];
          ?>
            <div class="testimoni-single"><!--Testimoni Single-->

              <div class="col-sm-2 testi-photo">
                <img src="<?php echo $img; ?>" width="117" height="114" onError="this.src='<?php echo images_uri(); ?>default-profile.jpg'">
              </div>

              <div class="col-sm-10 testi-box">
                <div class="petik-kanan"><img src="<?php echo $this->config->item('template_uri');?>images/petik.png"></div>
                <div class="petik-kiri"><img src="<?php echo $this->config->item('template_uri');?>images/petik-rev.png"></div>
                <div class="testi-arrow"></div>
                <div class="testi-isi">
                  <div class="testi-single-name"> <?php echo stripslashes($key['testimoni_name']); ?> &nbsp;<span class="testi-tag">|&nbsp; <?php echo $key['testimoni_about']; ?></span></div>
                  <div class="testi-content">
                    <blockquote>
                      <?php echo html_entity_decode($key['testimoni_content']); ?>
                    </blockquote>
                  </div>
                  <div class="testi-single-date"><?php echo $showdate; ?></div>
                </div>
              </div>

            </div><!--//Testimoni Single-->

            <?php } ?>            