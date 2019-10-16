    <div class="highlight-wrap"><!--Header highlight wrapper-->

        <div class="carousel slide" id="myCarousel"><!--slider-->
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
                                    <a href="<?php echo $rows->h_url?>"><h1><?php echo $rows->h_title ?></h1></a>
                                    <p><?php echo html_entity_decode($str)?></p>
                                    <a href="#">
                                        <div class="highlight-read-more">
                                            <a href="<?php echo $rows->h_url?>">
                                            <div class="text">Read more</div>
                                                <div class="arrow">
                                                    <i class="fa fa-angle-double-right fa-3x" aria-hidden="true"></i>
                                                </div>
                                            </a>
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



            <!-- Controls -->
            <a class="left carousel-control" href="javascript:void(0)" data-target="#myCarousel" data-slide="prev">
                <i class="fa fa-angle-left fa-3x" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="javascript:void(0)" data-target="#myCarousel" data-slide="next">
                <i class="fa fa-angle-right fa-3x" aria-hidden="true"></i>
            </a>

        </div><!--//slider-->

    </div><!--//Header highlight wrapper-->

    <div class="highlight-wrapper">
        <div class="container">

            <div class="highlight-sign">
                HIGHLIGHT
            </div>

            <div class="row">

                <?php
                $path = parseDateTime($csr[0]['c_created_date']);
                $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$csr[0]['c_id'] .'/'.$csr[0]['c_images_thumbnail'];
                ?>
                <div class="col-lg-3">
                    <img width="236" height="158" src="<?php echo $image_url; ?>">
                </div>

                <!-- CSR -->
                <div class="col-lg-9">
                    <div class="highlight-title"><a href="<?php echo site_url('csr'); ?>"><?php echo $csr[0]['c_title']; ?></a></div>
                    <div class="highlight-date"><?php echo date('l, d F Y', strtotime($csr[0]['c_publish_date'])); ?></div>
                    <hr/>
                    <div class="highlight-text"><?php echo html_entity_decode($csr[0]['c_summary']); ?></div>
                    <div class="more-button">
                        <a href="<?php echo site_url('csr'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="layanan-wrapper"><!--Layanan bank-->
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <h1>LAYANAN KAMI</h1>
                    <ul>
                        <?php // ------- Looping Highlight Menu -------
                        $dataid = 1;
                        foreach ($highlight as $key) {
                        ?>

                        <a href="javascript:void(0);" class="linkContent <?php echo ($dataid==1)? 'active' : ''; ?>" data="<?php echo $dataid; ?>"><li><i class="fa fa-check-square <?php echo ($dataid==1)? 'active' : ''; ?>" aria-hidden="true"></i> <?php echo $key['hi_title']; ?></li></a>

                        <?php $dataid++;
                        } ?>
                    </ul>
                </div>

                <div class="col-lg-8 col-lg-offset-1">

                    <?php // ------- Looping Content Highlight -------
                        $dataid = 1;
                        foreach ($highlight as $key) {
                        ?>

                        <div class="wrapperContent <?php echo ($dataid==1)? 'active' : ''; ?>" id="<?php echo $dataid; ?>">
                            <?php echo html_entity_decode($key['hi_content']); ?>
                            <br><a href="<?php echo $key['hi_link']; ?>" class="btn" title="Selengkapnya">Selengkapnya</a>
                        </div>

                        <?php $dataid++;
                        } ?>
                </div>

            </div>
        </div>
    </div><!--//Layanan bank-->

    <div class="bottom-content-wrapper"><!--Bottom contents-->
        <div class="container">
            <div class="row">

                <div class="col-sm-4"><!--Sejarah singkat & Testimonial-->
                    <div class="sejarah-singkat">
                        <h1>SEJARAH SINGKAT</h1>
                        <p><?php echo html_entity_decode($sejarah['p_summary']); ?></p>

                        <div class="more-button">
                            <a href="<?php echo site_url('page/sejarah-singkat'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>

                        <hr/>

                        <div class="testimonial">
                            <h1>TESTIMONIAL</h1>
                            <div class="carousel slide" id="myCarousel2"><!--slider-->
                                <ol class="carousel-indicators testimoni">
                                <?php
                                    if($testimoni->num_rows()>0){
                                        $no = 1;
                                        $no_slide = $no - 1;
                                        foreach ($testimoni->result() as $rows) {
                                            $cls = "";
                                            if($no==1) {
                                                $cls = "active";
                                            }
                                            ?>
                                                <li data-target="#myCarousel2" data-slide-to="<?php echo $no_slide; ?>" class="item1 <?php echo $cls; ?>"></li>
                                            <?php
                                            $no++;$no_slide++;
                                        }
                                    }
                                ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php
                                        if($testimoni->num_rows()>0){
                                            $no = 1;
                                            foreach ($testimoni->result() as $rows) {
                                                $cls = "";
                                                if($no==1) {
                                                    $cls = "active";
                                                }
                                                ?>
                                                    <div class="item slide <?php echo $cls; ?>" id="slide<?php echo $no; ?>">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="<?php echo base_url('images-data/testimoni/'.$rows->testimoni_id.'/'.$rows->testimoni_image)?>" onError="this.src='<?php echo images_uri(); ?>default-profile.jpg'">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="testi"><?php echo html_entity_decode($rows->testimoni_content) ?></div>
                                                                <div class="testi-name"><?php echo $rows->testimoni_name ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                $no++;
                                            }
                                        }
                                    ?>
                                </div>
                            </div><!--//slider-->
                            <div class="more-button">
                                <a href="<?php echo site_url('testimoni'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>

                    </div>
                </div><!--//Sejarah singkat & testimonial-->

                <div class="col-sm-5"><!--berita-->
                    <div class="home-berita">

                        <h1>BERITA</h1>
                        <br/>

                        <?php
                            foreach ($berita as $post) {
                                $path = parseDateTime($post['c_created_date']);
                                $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];

                                $date = parseDateTime($post['c_publish_date']);
                                $b_url = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
                        ?>
                        <div class="home-berita-single">
                            <div class="row">

                                <div class="col-sm-4 berita-thmb">
                                    <a href="<?php echo $b_url; ?>">
                                      <img src="<?php echo $image_url; ?>" onError="this.src='<?php echo images_uri(); ?>logo-banksulselbar-sm.jpg'" class="img-responsive">
                                    </a>
                                </div>

                                <div class="col-sm-8">
                                    <a href="<?php echo $b_url; ?>"><p class="home-berita-title"><?php echo stripslashes($post['c_title']); ?></p></a>
                                    <p class="home-berita-date"><?php echo date('l, d F Y', strtotime($post['c_publish_date'])); ?></p>
                                    <!-- <p class="home-berita-text"><?php echo html_entity_decode($post['c_summary']); ?></p> -->
                                </div>

                            </div>
                        </div>
                        <?php } ?>

                        <div class="more-button">
                            <a href="<?php echo site_url('berita'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>

                    </div>
                </div><!--//berita-->

                <div class="col-sm-3"><!--Sejarah singkat & Testimonial-->
                    <div class="sejarah-singkat no-padding">
                        <h1>VIDEO</h1>
                        <p>
                            <?php
                                foreach ($video as $post) {
                                    $path  = parseDateTime($post['c_created_date']);
                                    $url   = base_url() . 'video/read/'. $path['year'].$path['month'] .$path['day'] .'/'. $post['c_id'] .'/'. $post['c_slug'];
                                    $image = $this->config->item('images_posts_uri') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $post['c_id'] .'/'. $post['c_images_thumbnail'];

                                    ?>
                                        <a href="<?=$url?>">
                                            <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                                <div class="galeri-thumbnail-veil">
                                                    <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                                </div>
                                                <img src="<?php echo $image; ?>">
                                            </div><!--//Galeri Thumbnail-->
                                        </a>
                                        <div class="title"><?php echo $post['c_title']; ?></div>
                                    <?php
                                }
                            ?>
                        </p>

                        <div class="more-button">
                            <a href="<?php echo site_url('video'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div><!--//video-->

            </div>
        </div>
    </div><!--//Bottom content-->
