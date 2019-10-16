    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Berita</span>
        </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
        <div class="container">

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

        </div>
    </div><!--//Main content-->