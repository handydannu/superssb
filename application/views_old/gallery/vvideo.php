<?php 
// ----- Set next dan prev button -----
$page = $this->uri->segment(2);
$galeri_url = 'video';

if (!empty($page) && !is_numeric($page)) {
    // paging kanal
    $page       = $this->uri->segment(3);
    $galeri_url = 'video/'.$this->uri->segment(2);
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
        <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Galeri&nbsp;/&nbsp;Video</span>
        </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
        <div class="container galeri">   
                    
            <div class="galeri-row"><!--Galeri Single Row-->
                <div class="row">
                   <?php 
                        foreach ($articles as $post) {
                            $path  = parseDateTime($post['c_created_date']);
                            $url   = base_url() . 'video/read/'. $path['year'].$path['month'] .$path['day'] .'/'. $post['c_id'] .'/'. $post['c_slug'];
                            $image = $this->config->item('images_posts_uri') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $post['c_id'] .'/'. $post['c_images_thumbnail'];
                        
                            $tgl = parseDateTime($post['c_publish_date']);
                            $tgl = $tgl['day'].' '.$tgl['month_ind_name'].' '.$tgl['year'];

                            $subtitle = stripslashes($post['c_subtitle']);
                            $subtitle = (empty($subtitle))? '' : '<h4>'.$subtitle.'</h4>';
                            $mainTitle = stripslashes($post['c_title']);
                            ?>
                                <div class="col-lg-4"><!--Galeri Single Box-->
                                    <a href="<?=$url?>">
                                        <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                            <div class="galeri-thumbnail-veil">
                                                <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                            </div>
                                            <img src="<?php echo $image; ?>">
                                        </div><!--//Galeri Thumbnail-->
                                        <p class="galeri-caption"><?php echo $mainTitle; ?></p><!--Galeri Caption-->
                                    </a>
                                </div><!--//Galeri Single Box-->
                            <?php 
                        } 
                    ?>

                </div>
            </div><!--//Galeri Single Row-->

            <center>
                <center>
                    <?php echo $pagination; ?>
                </center>
            </center>

        </div>
    </div><!--//Main content-->

    <div class="up-btn"><!--Up Button-->
        <a href="#top">
            <img src="assets/img/up-btn.png">
            <img src="assets/img/up-btn2.png">
        </a>
    </div><!--//Up Button-->