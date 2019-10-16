<!-- BREADCRUMB -->
<div class="breadcrumb-temp">
    <div class="container">
        <span class="canal-title">Home</span><span class="canal-subtitle">&nbsp;/&nbsp;Berita & Tips</span>
    </div>
</div>
<!-- BREADCRUMB END -->



<div class="main-content"><!--Main Content goes here-->
        <div class="container2" style="background-image: url(https://banksulselbar.co.id/assets/img/bg3.png);background-position:left-top;background-repeat:repeat-x">
          <div class="row">
            <div class="col-md-8">
                <div class="berita-single">
                    <div class="row">
                        <div class="berita-detail-title">
                            <?php
                                if(! empty($detail['c_subtitle'])){
                                    ?>
                                        <h4 style="margin-bottom:5px"><i class="fa fa-caret-right" aria-hidden="true"><?php echo stripslashes($detail['c_subtitle']); ?></i></h4>
                                    <?php        
                                }
                            ?>
                            
                            <h1 style="margin-top:0"><?php echo stripslashes($detail['c_title']); ?></h1>
                            <p><?php echo $showdate; ?></p>
                            <div class="share-on">
                                <?php echo $share; ?>
                            </div>
                        </div>

                        <hr style="border-top: 1px dotted #9ec53b;"/>

                        <div class="berita-content">
                            <?php if ( !empty($detail['c_images_content']) ) {
                              ?>
                                <img class="img-responsive" src="<?php echo $img_article ?>" alt="<?php echo $detail['c_title']; ?>">
                                <p class="caption-img"><?php echo $detail['c_images_caption']; ?></p>
                              <?php
                            }?>
                            <?php echo html_entity_decode($detail['c_content']); ?>
                        </div>
                        <br/>
                        <a class="kembali-btn" href="javascript:;" onclick="history.back(-1)">
                          <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Kembali
                        </a>
                    </div>        
                </div>
            </div>

            <div class="col-md-4 berita-video-foto">
              
                <!-- Simulasi Kredit -->
                <div class="simulasi-kredit">
                    <div class="kredit-title">SIMULASI KREDIT</div>
                    <div class="kredit-content">
                      <form role="form" id="formID" action="<?php echo site_url('kalkulator-kredit'); ?>" method="post">
                        <div class="form-group">
                          <label for="">Jumlah Kredit:</label>
                          <input type="input" class="form-control" name="kredit" id="kredit" value="<?php echo $EDIT['kredit'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                        </div>
                        <div class="form-group row">
                          <div class="col-xs-9">
                            <label for="">Jangka Waktu:</label>
                            <input type="input" class="form-control" name="waktu" id="waktu" size="5" value="<?php echo $EDIT['waktu'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                          </div>
                          <label class="control-label col-xs-3 label-prefix" for="">(Bulan)</label>
                        </div>
                        <div class="form-group row">
                          <div class="col-xs-9">
                            <label for="">Bunga Pertahun:</label>
                            <input type="input" class="form-control" name="bunga" id="bunga" size="4" value="<?php echo $EDIT['bunga'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                          </div>
                          <label class="control-label col-xs-1 label-prefix percent" for="">%</label>
                        </div>
                        <div class="form-group">
                          <label for="">Perhitungan Suku Bunga :</label><br/>
                          <div class="row">
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="flat" name="tipebunga" type="checkbox" value="flat">
                                <label class="checkbox-inline" for="flat" title="Flat">Flat</label>
                              </div>
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="efektif" name="tipebunga" type="checkbox" value="efektif">
                                <label class="checkbox-inline" for="efektif" title="Efektif">Efektif</label>
                              </div>
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="anuitas" name="tipebunga" type="checkbox" value="anuitas">
                                <label class="checkbox-inline" for="anuitas" title="Anuitas">Anuitas</label>
                              </div>
                          </div>
                        </div>
                        <input name="calc" type="hidden" id="calc" value="Kalkulasi" />
                        <button type="submit" class="btn btn-default btn-kredit">Hitung Kalkulasi</button>
                      </form>
                    </div>
                </div>
                <!-- End Simulasi Kredit -->

                <!-- Video -->
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
                <!-- End Video -->

                <!-- Foto -->
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
                <!-- End Foto -->

                <!-- Links -->
                <div class="home-links">
                  <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link1.png" /></a>
                  <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link2.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link3.png" /></a>
                  <a href="http://www.bi.go.id" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link4.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link5.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link6.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link7.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link8.png" /></a>
                </div>
                <!-- End Links -->
              </div>

            </div>
        </div>
    </div><!--//Main content-->