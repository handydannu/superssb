    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Berita</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container berita-single-container">   
                    
            <div class="berita-detail">

                <div class="berita-detail-title">
                    <h1><?php echo stripslashes($detail['c_title']); ?></h1>
                    <p><?php echo $showdate; ?></p>
                    <div class="share-on">
                        <?php echo $share; ?>
                    </div>
                </div>

                <div class="berita-content">
                    <?php if (@getimagesize($img_article)) { ?>
                    <img src="<?php echo $img_article ?>" alt="<?php echo $detail['c_title']; ?>">
                    <?php } ?>

                    <?php echo html_entity_decode($detail['c_content']); ?>
                </div>

                <a class="kembali-btn" href="javascript:;" onclick="history.back(-1)">
                  <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Kembali
                </a>
            </div>

        </div>
    </div>