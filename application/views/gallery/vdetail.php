<div class="breadcrumb-temp">
    <div class="container">
    <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Galeri&nbsp;/&nbsp;Foto</span>
    </div>
</div>

<div class="main-content"><!--Main Content goes here-->
    <div class="container galeri">   
                
        <div class="slideshow"><!--Slideshow-->
             <div class="carousel slide" id="myCarousel2"><!--slider-->
        
                <div class="carousel-inner">
                    <?php
                        $total = count($photos);
                        if($photos > 0) {
                            $no = 1;                               
                            for($i=0; $i < $total; $i++){
                                $photo          = $photos[$i];
                                $path           = parseDateTime($photo['album_created_date']);
                                $image          = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images'];
                                $image_thumb    = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images_thumbnail'];
                                $cls = "";
                                if($no==1) {
                                    $cls = "active";
                                }
                                ?>
                                <div class="item slide <?php echo $cls ?>">
                                    <div class="slide-image">
                                        <img src="<?php echo $image;?>">
                                        <p><?php echo htmlspecialchars_decode($photo['ph_caption']); ?></p>
                                    </div>
                                </div>                          
                            <?php
                            $no++;
                            }
                        }
                    ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control galeri-detil" href="javascript:void(0)" data-target="#myCarousel2" data-slide="prev">
                    <i class="fa fa-angle-left fa-3x" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control galeri-detil" href="javascript:void(0)" data-target="#myCarousel2" data-slide="next">
                    <i class="fa fa-angle-right fa-3x" aria-hidden="true"></i>
                </a>

            </div><!--//slider-->
        </div><!--//Slideshow-->

        <h2>Foto lainnya : </h2>
        <div class="row galeri-detil-row"><!--Image Thumbnail row-->                
            <?php 
                $loop  = count($other_photos_total);
                foreach ($other_photos as $other) {
                    $path        = parseDateTime($other['album_created_date']);
                    $url         = base_url().'foto/read/'.$path['year'].$path['month'].$path['day'].'/'.$other['album_id'].'/'.$other['album_slug'];
                    $image_thumb = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$other['ph_album_id'].'/'.$other['ph_images_thumbnail'];
                
                    // total foto di masing-masing album
                    for ($j=0; $j < $loop; $j++) { 
                        $jumlah_foto = $other_photos_total[$j]['ph_total'];
                        if ($other['album_id'] == $other_photos_total[$j]['ph_album_id'])
                        {
                            break;
                        }
                    }

                    $jumlah_foto = $jumlah_foto.' foto';
                    ?>
                        <div class="col-lg-4"><!--Galeri Single Box-->
                            <a href="<?php echo $url; ?>">
                                <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                    <div class="galeri-thumbnail-veil">
                                        <i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                                        <p><?php echo $jumlah_foto; ?></p>
                                    </div>
                                    <img src="<?php echo $image_thumb; ?>">
                                </div><!--//Galeri Thumbnail-->
                                <p class="galeri-caption"><?php echo $other['album_title']; ?></p><!--Galeri Caption-->
                            </a>
                        </div><!--//Galeri Single Box-->
                    <?php 
                } 
            ?>
            
        </div><!--//Image Thumbnail row-->
        <a class="kembali-btn" href="javascript:;" onclick="history.back(-1)">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Kembali
        </a>
    </div>
</div><!--//Main content-->

<div class="up-btn"><!--Up Button-->
    <a href="#top">
        <img src="<?php echo site_url("assets/images/up-btn.png")?>">
        <img src="<?php echo site_url("assets/images/up-btn2.png")?>">
    </a>
</div><!--//Up Button-->