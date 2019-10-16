  <!-- </div><!--//Container -->

<div class="breadcrumb-temp">
  <div class="container">
  <p></p>
  </div>
</div>


    <div class="row">

      <div class="col-md-4 col-xs-12" style="padding: 0px;">

        

        <div class="home-video">

        

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

                   

                <?php

            }

          ?>



        </div>



        <div class="home-video foto">

         
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

      <div class="col-md-8 col-xs-12 highlight-slider">

        <div class="highlight-wrap">

          <div class="carousel slide" id="myCarousel">



            

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

                             

                          </div>

                      <?php

                      $no++;

                      }

                  }

              ?>

            </div>



          </div><!--//slider-->

        </div>
        <!--//Header highlight wrapper-->

      </div>

    



  <!-- </div><!--//Container--><!--//Body Content Top-->


 
  <div class="home-mid">

    <div class="row">
    <div class="col-md-12 col-xs-12" style="padding: 0;">
      <marquee style="background: #ffffff"><h4 style="font-size: 15px;">
      <?php

                foreach ($berita as $post) {

                  $path = parseDateTime($post['c_created_date']);

                  $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];



                  $date = parseDateTime($post['c_publish_date']);

                  $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];

                  ?>

                    
                      <a href="<?php echo $b_url; ?>"><i><?php echo stripslashes($post['c_title']); ?></i></a> | 

                    

                  <?php

                }

              ?>
            </h4>
          </marquee>
    </div>


      <div class="col-md-8 col-xs-12 berita">

       







        

      <ul class="nav nav-tabs kredit-title2" >
        <li class="active"><a data-toggle="tab" href="#berita">BERITA</a></li>
        <li><a data-toggle="tab" href="#pengumuman">PENGUMUMAN</a></li>
        <li><a data-toggle="tab" href="#pengumuman_lain">PENGUMUMAN LAIN</a></li>
      </ul>


        <div class="tab-content">
          <div id="berita" class="tab-pane fade in active">
              <div class="kredit-content">
                <?php

                foreach ($berita as $post) {

                  $path = parseDateTime($post['c_created_date']);

                  $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];



                  $date = parseDateTime($post['c_publish_date']);
                  $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                  $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];

                  ?>

                    <div class="home-berita-single">

                      <a href="<?php echo $b_url; ?>"><p class="home-berita-title"><?php echo stripslashes($post['c_title']); ?></p></a>
                      <p class="date"><?php echo $showdate; ?></p>
                      <p class="home-berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p>

                      <!-- <p class="home-berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p> -->

                    </div>

                  <?php

                }

              ?>



              <a href="<?php echo site_url('berita'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>
              </div>
          </div>
          
          <div id="pengumuman" class="tab-pane fade">
              <?php
                foreach ($files as $data) {
                    $path          = parseDateTime($data['doc_created_date']);
                    $download_link = $this->config->item('pdf_dir') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $data['doc_id'] .'/'.$data['doc_file'];
                    $date = parseDateTime($data['doc_publish_date']);
                    $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    ?>
                        <div class="lelang-single"><!--Informasi lelang single row-->
                            <div class="row">
                                <div class="col-lg-2">
                                    <a class="donlod-btn1" href="<?=$download_link?>" download>
                                        <img src="<?php echo $this->config->item('template_uri');?>images/donlod1.png">
                                        <img src="<?php echo $this->config->item('template_uri');?>images/donlod2.png">
                                    </a>
                                </div>

                                <div class="col-lg-10"><!--Lelang Caption-->
                                    <a href="<?=$download_link?>" download><p class="title"><?php echo htmlspecialchars_decode($data['doc_title']); ?></p></a>
                                    <p class="date"><?php echo $showdate; ?></p>
                                    <p class="text"><?php echo htmlspecialchars_decode($data['doc_summary']); ?></p>
                                    <a href="<?=$download_link?>" class="btn donlod-btn2" title="Download" download> Download</a>
                                    <button type="button" class="btn donlod-btn2 popup_download" data-toggle="modal" data-target="#previewModal" data-download="<?php echo $download_link; ?>" data-title="<?php echo stripslashes($data['doc_title']); ?>">Preview</button>
                                </div>
                            </div>
                        </div><!--//Informasi lelang single row-->
                    <?php
                }
            ?>
              <a href="<?php echo site_url('download/pengumuman-lelang'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>
          </div>
          
          <div id="pengumuman_lain" class="tab-pane fade">
              <?php
                foreach ($files_lain as $data) {
                    $path          = parseDateTime($data['doc_created_date']);
                    $download_link = $this->config->item('pdf_dir') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $data['doc_id'] .'/'.$data['doc_file'];
                    $date = parseDateTime($data['doc_publish_date']);
                    $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    ?>
                        <div class="lelang-single"><!--Informasi lelang single row-->
                            <div class="row">
                                <div class="col-lg-2">
                                    <a class="donlod-btn1" href="<?=$download_link?>"download>
                                        <img src="<?php echo $this->config->item('template_uri'); ?>images/donlod1.png">
                                        <img src="<?php echo $this->config->item('template_uri'); ?>images/donlod2.png">
                                    </a>
                                </div>

                                <div class="col-lg-10"><!--Lelang Caption-->
                                    <a href="<?=$download_link?>"download><p class="title"><?php echo htmlspecialchars_decode($data['doc_title']); ?></p></a>
                                    <p class="date"><?php echo $showdate; ?></p>
                                    <p class="text"><?php echo htmlspecialchars_decode($data['doc_summary']); ?></p>
                                    <a href="<?=$download_link?>" class="btn donlod-btn2" title="Download" download> Download</a>
                                    <button type="button" class="btn donlod-btn2 popup_download" data-toggle="modal" data-target="#previewModal" data-download="<?php echo $download_link; ?>" data-title="<?php echo stripslashes($data['doc_title']); ?>">Preview</button>
                                </div>
                            </div>
                        </div><!--//Informasi lelang single row-->
                    <?php
                }
            ?>
              <a href="<?php echo site_url('download/other'); ?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>
          </div>
          
        </div>
        <div class="col-lg-12">
            <br>
            <h3 style="    color: #3272a8;font-weight: bold;">Artikel</h3>
        
        <div class="berita-single" style="padding: 5px;">
        </div>
        <?php
              foreach ($artikel as $post) {
                  $path = parseDateTime($post['c_created_date']);
                  $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];

                  $date = parseDateTime($post['c_publish_date']);
                  $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                  $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
              ?>
              
              <div class="berita-single"><!--Single Berita-->
                  
                      
                      <!--Berita Caption-->
                            
                          <p class="berita-date" style="    color: #999999;"> 
                              <i class="fa fa-calendar" aria-hidden="true"> </i> 
                               <?php echo $showdate; ?>
                          </p>
                          <a href="<?php echo $b_url; ?>"><i class="fa fa-external-link" aria-hidden="true" style="float: right;margin-top: -25px;margin-right: -40px;"></i>
                          </a>
                          <a href="<?php echo $b_url; ?>"><p class="berita-title"><?php echo stripslashes($post['c_title']); ?></p>
                         </a>
                          
                          
                     
              </div><!--//Single Berita-->
              <?php } ?>
        </div>

      </div>



     <div class="col-md-4 col-sm-6 col-xs-12 simulasi-kredit">
           
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
                  <button type="submit" class="btn btn-default">Hitung Kalkulasi</button>
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



      <div class="col-md-4 col-sm-6 col-xs-12">

        <img src="https://banksulselbar.co.id/assets/images/Design_Mobile_Banking.png" style="width: 100%;height: auto;padding-top: 15px;">

        

      </div>



    </div>

  <!-- </div><!--//Container--><!--//Body Content Mid



  <div class="container"> -->



    <div class="choy">

      

    </div>



    <div class="home-bottom-wrap">



      <div class="row">



        <div class="col-md-8">

          

        </div>







        <!--<div class="col-md-4 home-links">

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

        </div>-->



      </div>



    </div><!--//Bottom Content-->



  </div></div><!--//Container-->


<!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
              <iframe frameborder="0" width="860" height="570" src="" id="prev_content"></iframe>
          </div>
        </div>
      </div>
    </div>
    


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>