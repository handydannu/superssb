    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Search</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container">

            <?php 
        if (count($articles) > 0) {
            foreach ($articles as $post) {

                // Display Page

                if (!empty($post['p_id'])) {

                    $title     = stripslashes($post['p_title']);
                    $summary   = html_entity_decode($post['p_summary']);
                    $type      = '';
                    $image_url = 'tidak pakai gambar';
                    
                    $date      = parseDateTime(date('Y-m-d H:i:s'));
                    $showdate  = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    
                    $b_url     = base_url() . 'page/'. $post['p_slug'];

                }else if (!empty($post['c_id'])) {

                    // Diplay Article dan Video
                    $title     = stripslashes($post['c_title']);
                    $summary   = html_entity_decode($post['c_summary']);
                    $type      = ($post['c_content_type']=='video')? 'Video' : '';
                    $path      = parseDateTime($post['c_created_date']);
                    $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];

                    $date     = parseDateTime($post['c_publish_date']);
                    $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    if ($post['c_content_type']=='text') :
                        $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
                    elseif (($post['c_content_type']=='video')):
                        $b_url = base_url() . 'video/read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
                    endif;

                }else if (!empty($post['album_id'])) {

                    // Foto Album
                    $title     = stripslashes($post['album_title']);
                    $summary   = character_limiter(html_entity_decode($post['album_description']), 180);
                    $type      = 'Foto';

                    $path = parseDateTime($post['album_created_date']);
                    $image_url = $this->config->item('images_photo_uri') . $path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$post['album_id'].'/'.$post['ph_images_thumbnail'];
                    
                    $date      = parseDateTime($post['album_date'] . ' '.date('H:i:s'));
                    $showdate  = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    
                    $b_url     = base_url() . 'foto/read/'. $date['year'].$date['month'].$date['day'].'/'.$post['album_id'].'/'. $post['album_slug'];

                }
                
            ?>
            <div class="berita-single"><!--Single Berita-->
                <div class="row">
                    <div class="col-lg-3"><!--Berita Thumbnails-->
                        <a href="<?php echo $b_url; ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo $$title; ?>" onError="this.src='<?php echo images_uri(); ?>logo-big.png'"></a>
                    </div>
                    <div class="col-lg-9"><!--Berita Caption-->
                        <a href="<?php echo $b_url; ?>"><p class="berita-title"> <?php echo ($type!='')? '<span style="font-size:14px;">'.$type.'</span><br>' : ''; ?> <?php echo $title; ?></p></a>
                        <p class="berita-date"> <?php echo $showdate; ?></p>
                        <p class="berita-text"><?php echo $summary; ?></p>
                        <br/>
                        <a class="kembali-btn" href="<?php echo $b_url; ?>">
                          Selengkapnya &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>    

                </div>
            </div><!--//Single Berita-->

            <?php } ?>
            
            <center>
                <?php echo $pagination; ?>
            </center>

        <?php }else{ ?>


            <div class="berita-single">
                <div class="row">
                    <div class="col-lg-9">
                        <p class="berita-text"> Berita Tidak Ditemukan.</p>
                    </div>    

                </div>
            </div>
        <?php } ?>

        </div>
    </div><!--//Main content-->