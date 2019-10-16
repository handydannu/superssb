<?php
// ----- Set next dan prev button -----
$page = $this->uri->segment(2);
$galeri_url = 'foto';

if (!empty($page) && !is_numeric($page)) {
    // paging kanal
    $page       = $this->uri->segment(3);
    $galeri_url = 'foto/'.$this->uri->segment(2);
}

$page = (empty($page))? '1' : $page;
if ($page==1 && $page != $totalpages)
{
    $prev_page = '';
    $next_page = 2;

    $prev_style = 'style="pointer-events:none;"';
    $next_style = '';
    $backbtn    = 'btn-back';
    $nextbtn    = 'btn-next';
}elseif ($page==1 && $page == $totalpages)
{
    $prev_page = '';
    $next_page = '';

    $prev_style = 'style="pointer-events:none;"';
    $next_style = 'style="pointer-events:none;"';
    $backbtn    = 'btn-back';
    $nextbtn    = 'btn-back';
}elseif ($page >= $totalpages){
    $prev_page = $page-1;
    $next_page = '';

    $prev_style = '';
    $next_style = 'style="pointer-events:none;"';
    $backbtn    = 'btn-next';
    $nextbtn    = 'btn-back';
}else{
    $prev_page = $page-1;
    $next_page = $page+1;

    $prev_style = '';
    $next_style = '';
    $backbtn    = 'btn-next';
    $nextbtn    = 'btn-next';
}
?>

<div class="breadcrumb-temp">
    <div class="container">
        <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Galeri&nbsp;/&nbsp;Foto</span>
    </div>
</div>

<div class="main-content"><!--Main Content goes here-->
    <div class="container galeri">
        <div class="galeri-row"><!--Galeri Single Row-->
            <div class="row">
                <?php
                    $a = 3;
                    $total = count($albums);
                    $loop  = count($total_foto);
                    for ($i=0; $i < $a; $i++) {
                        $photo = $albums[$i];
                        $path  = parseDateTime($photo['album_created_date']);
                        $image = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images_thumbnail'];
                        $url   = base_url(). 'foto/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];

                        // total foto di masing-masing album
                        for ($j=0; $j < $loop; $j++) {
                            $jumlah_foto = $total_foto[$j]['ph_total'];
                            if ($photo['album_id'] == $total_foto[$j]['ph_album_id'])
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
                                        <img src="<?php echo $image; ?>">
                                    </div><!--//Galeri Thumbnail-->
                                    <p class="galeri-caption"><?php echo htmlspecialchars_decode($photo['album_title']); ?></p><!--Galeri Caption-->
                                </a>
                            </div><!--//Galeri Single Box-->
                        <?php
                    }
                ?>
            </div>

            <div class="row">
                <?php

                    $total = count($albums);
                    $loop  = count($total_foto);
                    for ($i=$a; $i < $total; $i++) {
                        $photo = $albums[$i];
                        $path  = parseDateTime($photo['album_created_date']);
                        $image = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images_thumbnail'];
                        $url   = base_url(). 'foto/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];

                        // total foto di masing-masing album
                        for ($j=0; $j < $loop; $j++) {
                            $jumlah_foto = $total_foto[$j]['ph_total'];
                            if ($photo['album_id'] == $total_foto[$j]['ph_album_id'])
                            {
                                break;
                            }
                        }

                        $jumlah_foto = $jumlah_foto.' foto';
                        ?>
                            <div class="col-lg-4 col-sm-6"><!--Galeri Single Box-->
                                <a href="<?php echo $url; ?>">
                                    <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                        <div class="galeri-thumbnail-veil">
                                            <i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                                            <p><?php echo $jumlah_foto; ?></p>
                                        </div>
                                        <img src="<?php echo $image; ?>">
                                    </div><!--//Galeri Thumbnail-->
                                    <p class="galeri-caption"><?php echo htmlspecialchars_decode($photo['album_title']); ?></p><!--Galeri Caption-->
                                </a>
                            </div><!--//Galeri Single Box-->
                        <?php
                    }
                ?>
            </div>
        </div><!--//Galeri Single Row-->

        <center>
            <?php echo $pagination; ?>
        </center>

    </div>
</div><!--//Main content-->

<div class="up-btn"><!--Up Button-->
    <a href="#top">
        <img src="<?php echo site_url('assets/images/up-btn.png')?>">
        <img src="<?php echo site_url('assets/images/up-btn2.png')?>">
    </a>
</div><!--//Up Button-->
