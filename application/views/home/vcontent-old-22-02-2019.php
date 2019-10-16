  <!-- </div><!--//Container -->

<div class="breadcrumb-temp">
  <div class="container">
  <p></p>
  </div>
</div>


    <div class="row">



      <div class="col-md-8 col-xs-12 highlight-slider">

        <div class="highlight-wrap"><!--Header highlight wrapper-->

          <div class="carousel slide" id="myCarousel"><!--slider-->



            <!--indicator-->

            <ol class="carousel-indicators">

                <li data-target="#myCarousel" data-slide-to="0" class="item1 active"></li>

                <li data-target="#myCarousel" data-slide-to="1" class="item2"></li>

                <li data-target="#myCarousel" data-slide-to="2" class="item3"></li>

                <li data-target="#myCarousel" data-slide-to="3" class="item4"></li>

                <li data-target="#myCarousel" data-slide-to="4" class="item5"></li>

            </ol>



            <div class="carousel-inner">

              <?php

                  if($headline->num_rows()>0) {

                      $no = 1;

                      foreach ($headline->result() as $rows) {

                      $str = $rows->h_summary;

                      $cls = "";

                      if($no==1) {

                          $cls = "active";

                      }

                      ?>

                          <div class="item <?php echo $cls ?>">

                              <img src="<?php echo $this->config->item('images_headline_uri') .$rows->h_id.'/'.$rows->h_image; ?>">

                              <!--highlight header box-->

                              <div class="highlight-box">

                                  <a href="<?php echo $rows->h_url?>"><h3><?php echo $rows->h_title ?></h3></a>

                                  <p><?php echo html_entity_decode($str)?></p>

                                  <a href="<?php echo $rows->h_url?>">

                                      <div class="highlight-read-more">

                                          <div class="text">Read more</div>

                                          <div class="arrow">

                                              <i class="fa fa-angle-double-right fa-2x" aria-hidden="true"></i>

                                          </div>

                                      </div>

                                  </a>

                              </div>

                              <!--//Highlight box-->

                          </div>

                      <?php

                      $no++;

                      }

                  }

              ?>

            </div>



          </div><!--//slider-->

        </div><!--//Header highlight wrapper-->

      </div>

    <div class="col-md-4 col-xs-12 simulasi-kredit">
           
    <ul class="nav nav-tabs kredit-title2" >
    <li class="active"><a data-toggle="tab" href="#kredit">SIMULASI KREDIT</a></li>
    <li><a data-toggle="tab" href="#sukubunga">SUKU BUNGA</a></li>
  </ul>


  <div class="tab-content">
    <div id="kredit" class="tab-pane fade in active">
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
    
    <div id="sukubunga" class="tab-pane fade">
        
      <div class="kredit-title">DEPOSITO</div>
        <table id="tablePreview" class="table table-striped table-hover table-borderless">
          <thead>
            <tr>
              <th>Tenor</th>
              <th>Counter Rate</th> 
            </tr>
          </thead>
          <!--Table head-->
          <!--Table body-->
          <tbody>
            <tr>
              <td>1 (Satu) bulan</td>
              <td>5.75% p.a</td>
            </tr>
            <tr>
              <td>3 (Tiga) bulan</td>
              <td>6.00% p.a</td>
            </tr>
            <tr>
              <td>6 (Enam) bulan</td>
              <td>6.25% p.a</td>
            </tr>
            <tr>
              <td>12 (Dua Belas) bulan</td>
              <td>6.50% p.a</td>
            </tr>
          </tbody>
        </table>
    </div>
    
    </div>
    </div><!--//Row-->



  <!-- </div><!--//Container--><!--//Body Content Top-->



  <div class="home-mid">

    <div class="row">



      <div class="col-md-5 col-xs-12">

        <h4 class="title">BERITA</h4>







        <?php

          foreach ($berita as $post) {

            $path = parseDateTime($post['c_created_date']);

            $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];



            $date = parseDateTime($post['c_publish_date']);

            $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];

            ?>

              <div class="home-berita-single">

                <a href="<?php echo $b_url; ?>"><p class="home-berita-title"><?php echo stripslashes($post['c_title']); ?></p></a>

                <p class="home-berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p>

                <!-- <p class="home-berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p> -->

              </div>

            <?php

          }

        ?>



        <a href="<?php echo site_url('berita'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>



      </div>



      <div class="col-md-3 col-sm-6 col-xs-12 home-article">

        <div style="background: #e0eaf1;">



          <h4 class="title">ARTIKEL</h4>

          <a href="<?php echo site_url('artikel'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>

          <hr style="border-top: 1px solid #6a96e7;margin: 0px 15px 20px" />



          <?php

            foreach ($artikel as $post) {

              $path = parseDateTime($post['c_created_date']);

              $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];



              $date = parseDateTime($post['c_publish_date']);

              $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];

              ?>

                <div class="home-article-single">

                   <a href="<?php echo $b_url; ?>"><p><?php echo stripslashes($post['c_title']); ?></p></a>

                </div>

              <?php

            }

          ?>



        </div>

      </div>



      <div class="col-md-4 col-sm-6 col-xs-12 home-video-foto">



        <div class="home-video">

          <h4 class="title">VIDEO</h4>

          <a href="<?php echo site_url('video'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>



          <?php

            foreach ($video as $post) {

                $path  = parseDateTime($post['c_created_date']);

                $url   = base_url() . 'video/read/'. $path['year'].$path['month'] .$path['day'] .'/'. $post['c_id'] .'/'. $post['c_slug'];

                $image = $this->config->item('images_posts_uri') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $post['c_id'] .'/'. $post['c_images_thumbnail'];



                ?>

                    <a href="<?=$url?>">

                      <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->

                        <div class="galeri-thumbnail-veil">

                          <img class="play" src="<?php echo $this->config->item('template_uri');?>img/play-btn.png" />

                        </div>

                        <img src="<?php echo $image; ?>">

                      </div><!--//Galeri Thumbnail-->

                    </a>

                    <a href="<?=$url;?>" style="color:#316fc4;"><p style="margin-top:5px"><?php echo $post['c_title']; ?></p></a>

                <?php

            }

          ?>



        </div>



        <div class="home-video foto">

          <h4 class="title">FOTO</h4>

          <a href="<?php echo site_url('foto')?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>

          <div class="carousel slide" id="myCarousel2"><!--slider-->

            <div class="carousel-inner">

              <?php

                $total = count($foto);

                if($foto > 0) {

                    $no = 1;

                    for($i=0; $i < $total; $i++){

                        $photo          = $foto[$i];

                        $path           = parseDateTime($photo['album_created_date']);

                        $image          = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images'];

                        $image_thumb    = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images_thumbnail'];

                        $url            = base_url() . 'foto/read/'. $path['year'].$path['month'] .$path['day'].'/'.$photo['album_id'].'/'.$photo['album_title'];

                        $cls = "";

                        if($no==1) {

                            $cls = "active";

                        }

                        ?>

                        <div class="item slide<?php echo $no?> <?php echo $cls?>" id="slide<?php echo $no?>">

                          <a href="<?=$url?>">

                            <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->

                              <div class="galeri-thumbnail-veil">

                                <p>

                                  <?php echo $photo['ph_title']?>

                                </p>

                              </div>

                              <img src="<?php echo $image;?>">

                            </div><!--//Galeri Thumbnail-->

                          </a>

                        </div>

                    <?php

                    $no++;

                    }

                }

              ?>

            </div>

            <!-- Controls -->

            <a class="left carousel-control" href="javascript:void(0)" data-slide="prev" data-target="#myCarousel2">

                <i class="fa fa-angle-left" aria-hidden="true"></i>

            </a>

            <a class="right carousel-control" href="javascript:void(0)" data-slide="next" data-target="#myCarousel2">

                <i class="fa fa-angle-right" aria-hidden="true"></i>

            </a>

          </div><!--//slider-->

        </div>

      </div>



    </div>

  <!-- </div><!--//Container--><!--//Body Content Mid



  <div class="container"> -->



    <div class="choy">

      <img src="<?php echo $this->config->item('template_uri');?>img/newbanner.gif" />

    </div>



    <div class="home-bottom-wrap">



      <div class="row">



        <div class="col-md-8">

          <div class="home-testimonial">

            <h2>Testimonial</h2>



             <?php

              foreach ($testimoni->result() as $post) {

                ?>

                  <div class="col-sm-3">

                    <div class="testi-photo">



                      <img src="https://www.banksulselbar.co.id/images-data/images/testimoni/<?php echo $post->testimoni_id ?>/<?php echo $post->testimoni_image?>">

                            

                    </div>

                  </div>



                  <div class="col-sm-6">

                    <div class="testi-name"><?php echo $post->testimoni_name ?></div>

                    <div class="testi"><?php echo html_entity_decode($post->testimoni_content) ?></div>

                    <br/>

                    <a href="<?php echo site_url('testimoni'); ?>" style="color: #a5a5a5">[more]</a>

                  </div>

                <?php

              }

            ?>



          </div>

        </div>







        <div class="col-md-4 home-links">

          <h2>Links</h2>

          <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link1.png" /></a>

          <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link2.png" /></a>

          <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link3.png" /></a>

          <a href="http://www.bi.go.id" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link4.png" /></a>

          <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link5.png" /></a>

          <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link6.png" /></a>

          <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link7.png" /></a>

          <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link8.png" /></a>

          <a href="https://sikepo.ojk.go.id/sikepo" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link9.png" /></a>

        </div>



      </div>



    </div><!--//Bottom Content-->



  </div></div><!--//Container-->
