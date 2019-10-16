    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Agenda Kegiatan</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container berita-single-container">   
                    
            <div class="berita-detail">

                <?php 
                // start Date
                $date = parseDateTime($detail['ev_startdate'].' '. date('H:i:s'));
                $start_date = $date['day_ind_name'].', '.$date['day'].' '.$date['month_ind_name'].' '.$date['year'];
                $start_time = $detail['ev_starttime'];

                // End Date
                $edate = parseDateTime($detail['ev_enddate'].' '. date('H:i:s'));
                $end_date = $edate['day_ind_name'].', '.$edate['day'].' '.$edate['month_ind_name'].' '.$edate['year'];
                $end_time = $detail['ev_endtime'];

                if ($start_date == $end_date){
                    $show_jadwal = $start_date.' Pukul '.substr($start_time, 0, -3) .' s/d '.substr($end_time, 0, -3);
                }else{
                    $show_jadwal = $start_date .' '.substr($start_time, 0, -3) .' s/d '. $end_date .' '.substr($end_time, 0, -3);
                }
                ?>

                <div class="berita-detail-title">
                    <h1><?php echo stripslashes($detail['ev_title']); ?></h1>
                    <p>Acara: <?php echo $show_jadwal; ?></p>

                    <div class="share-on">
                        <?php echo $share; ?>
                    </div>
                </div>

                <div class="berita-content">
                    <?php if (@getimagesize($img_article)) { ?>
                    <img src="<?php echo $img_article ?>" alt="<?php echo $detail['ev_title']; ?>">
                    <?php } ?>

                    <?php echo html_entity_decode($detail['ev_description']); ?>

                    <p><strong>Lokasi:</strong> <?php echo $detail['ev_location']; ?></p>
                    <p><strong>Alamat:</strong> <?php echo html_entity_decode($detail['ev_address']); ?></p>
                </div>

                <a class="kembali-btn" href="javascript:;" onclick="history.back(-1)">
                  <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Kembali
                </a>
            </div>

        </div>
    </div>