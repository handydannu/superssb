<div class="breadcrumb-temp">
        <div class="container">
        <?php 
            $list_channel = array('profil', 'simpanan', 'tapemda', 'pinjaman', 'syariah');
            $current_channel = strtolower($page_data['ch_name']);
            if (in_array($current_channel, $list_channel))
            {
                $breadcrumb = $page_data['ch_name'] .' / '. $page_data['p_title'];
            }else{
                $breadcrumb = $page_data['p_title'];
            }
        ?>

        <?php if ($this->uri->segment(2) == 'karir'){ ?>
        
        <span class="canal-title">Karir</span>
        
        <?php }else{ ?>
        
        <span class="canal-title"><?php echo $page_data['tp_name']; ?></span><span class="canal-subtitle">&nbsp;/&nbsp;<?php echo $breadcrumb; ?></span>
        
        <?php } ?>
        </div>
    </div>

    <div class="main-content">
        <div class="container berita-single-container">

            <div class="berita-detail">
                <div class="berita-content non-berita">
                    <?php echo html_entity_decode($page_data['p_content']);  ?>
                </div>
            </div>

        </div>
    </div>