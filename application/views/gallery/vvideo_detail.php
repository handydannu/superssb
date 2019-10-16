<div class="breadcrumb-temp">
    <div class="container">
        <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Galeri&nbsp;/&nbsp;Video</span>
    </div>
</div>

<div class="main-content"><!--Main Content goes here-->
    <div class="container galeri">          
        <div class="col-lg-10 col-lg-offset-1">
            <center>
                <?php
                    foreach ($articles as $post) {
                        $subtitle = stripslashes($post['c_subtitle']);
                        $subtitle = (empty($subtitle))? '' : '<h4>'.$subtitle.'</h4>';
                        $mainTitle = stripslashes($post['c_title']);
                        $y_id     = $post['c_youtube_id'];
                        ?>
                            <iframe class="video-embed" width="640px" height="360px" src="https://www.youtube.com/embed/<?php echo $post['c_youtube_id'] ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
                            <p><?php echo $mainTitle; ?></p>
                            <br/><br/>
                        <?php
                    }
                ?>
            </center>
            <a href="javascript:;" onclick="history.back(-1)"><img src="<?php echo $this->config->item('template_uri');?>images/kembali-btn.png"></a>
        </div>
    </div>
</div><!--//Main content-->